<?php

namespace App\Http\Controllers\User;

use App\Enums\FormStatus;
use App\Enums\TransactionEnum;
use App\Features\NsdlPanFeature;
use App\Helpers\PanCardHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PanCard;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BalanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class PanCardController extends Controller
{
    protected $balanceService;
    protected $transactionRepository;
    protected $userRepository;

    public function __construct(
        BalanceService $balanceService,
        TransactionRepositoryInterface $transactionRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->balanceService = $balanceService;
        $this->transactionRepository = $transactionRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $nsdlPanQuery = PanCard::query()->where('user_id', $request->user()->id)->latest();

            return DataTables::eloquent($nsdlPanQuery)
                ->addIndexColumn()
                ->addColumn('status', function ($nsdlPan) {
                    $badgeType = match ($nsdlPan->status) {
                        'complete' => 'success',
                        'pending' => 'info',
                        'failed' => 'danger',
                        default => 'secondary',
                    };
                    return view('components.badges', [
                        'type' => $badgeType,
                        'text' => ucfirst($nsdlPan->status),
                    ]);
                })

                ->addColumn('acknowledgement_no', fn($nsdlPan) => $nsdlPan->acknowledgement_no ? $nsdlPan->acknowledgement_no : "N/A")

                ->addColumn('created_at', fn($nsdlPan) => $nsdlPan->created_at->diffForHumans())
                ->addColumn('updated_at', fn($nsdlPan) => $nsdlPan->updated_at->diffForHumans())

                ->addColumn('action', function ($nsdlPan) {
                    return view('components.show-btn', ['url' => route('nsdl.pan-card.show', $nsdlPan->id)]) .
                        view('components.edit-btn', ['url' => route('nsdl.pan-card.edit', $nsdlPan->id)]) .
                        view('components.delete-btn', ['url' => route('nsdl.pan-card.destroy', $nsdlPan->id)]);
                })

                ->addColumn('more', function ($nsdlPan) {
                    return in_array($nsdlPan->status, [FormStatus::STATUS_PENDING, FormStatus::STATUS_PROCESSING])
                        ? view('components.pan-process', ['panCard' => $nsdlPan, 'processed' => false])
                        : view('components.pan-process', ['panCard' => $nsdlPan, 'processed' => true]);
                })


                ->make();
        }
        return view('nsdl-pan.index');
    }

    public function create()
    {
        $charges = (float) NsdlPanFeature::getFeatureCharges();

        if (!$this->balanceService->hasSufficientBalance($charges)) {
            return $this->balanceService->handleLowBalanceResponse();
        }
        return view('nsdl-pan.form', ['formData' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_mode' => ['required', 'in:EKYC,ESIGN'],
            'application_type' => ['required', 'in:49A,CR'],
            'category' => ['required', 'in:P'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:M,F,O'],
            'mobile' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email' => ['required', 'email', 'max:255'],
            'pan_type' => ['required', 'in:Y,N'],
            'consent' => ['accepted'],
        ]);

        $charges = (float) NsdlPanFeature::getFeatureCharges();
        $commission = (float) NsdlPanFeature::getFeatureCommission();
        $finalCharges =  $charges -  $commission;

        if (!$this->balanceService->hasSufficientBalance($charges)) {
            return $this->balanceService->handleLowBalanceResponse();
        }

        try {

            $panCard = PanCard::create([
                'user_id' => $request->user()->id,
                'unique_id' => PanCardHelper::generateOrderId(),
                'application_mode' => $request->application_mode,
                'application_type' => $request->application_type,
                'category' => $request->category,
                'branch_code' => 'NSDL_' . $request->user()->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'pan_type' => $request->pan_type,
                'consent' => $request->consent ? "Y" : "N",
                'transaction_fee' => $finalCharges,
                'status' => FormStatus::STATUS_PENDING,
            ]);

            $transactionData = [
                "user_id" => $request->user()->id,
                "transaction_type" => TransactionEnum::TYPE_INTERNAL,
                "transaction_direction" => TransactionEnum::DIRECTION_DEBIT,
                "vendor" => TransactionEnum::VENDOR_INTERNAL,
                "transaction_id" => TransactionHelper::generateTransactionId(),
                "opening_balance" => $request->user()->wallet,
                "amount" => $finalCharges,
                "fee" => 0,
                "tax" => 0,
                "closing_balance" => $request->user()->wallet - $finalCharges,
                "currency_id" => GeneralSetting::value('default_currency'),
                "payment_method" => TransactionEnum::METHOD_WALLET,
                "metadata" => [
                    'message' => "new panCard transaction",
                    'name' => $panCard->name,
                    'mobile' => $panCard->mobile,
                ],
                "ip_address" => request()->ip(),
                "user_agent" => request()->userAgent(),
                "processed_at" => now(),
                'status' => TransactionEnum::STATUS_COMPLETE
            ];

            if ($panCard) {
                $this->transactionRepository->create($transactionData);
                $this->userRepository->decrementWallet($request->user()->id, $finalCharges);
            }

            return redirect()->route('nsdl.pan-card.index')
                ->with(['message' => 'Application processed success.', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return redirect()->back()->with(['message' => 'application failed to process.', 'type' => "error"]);
        }
    }

    public function show(PanCard $panCard)
    {
        Gate::authorize('view', $panCard);
        return view('nsdl-pan.show', [
            'panCard' => $panCard
        ]);
    }

    public function edit(PanCard $panCard)
    {
        Gate::authorize('update', $panCard);
        try {
            if (!$this->isPendingStatus($panCard->status)) {
                throw new \Exception('The PanCard cannot be modified as its status is not pending.');
            }

            return view('nsdl-pan.form', ['formData' => $panCard]);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['stack' => $e->getTrace()]);
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function update(Request $request, PanCard $panCard)
    {
        Gate::authorize('update', $panCard);

        if (!$this->isPendingStatus($panCard->status)) {
            throw new \Exception('The PanCard cannot be modified as its status is not pending.');
        }

        $validatedData = $this->validatePanCardData($request);

        try {
            $panCard->update([
                ...$validatedData,
                'consent' => $validatedData['consent'] ? "Y" : "N",
            ]);

            return redirect()->route('nsdl.pan-card.index')
                ->with(['message' => 'Application processed successfully.', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['stack' => $e->getTrace()]);
            return redirect()->back()->with(['message' => 'Application failed to process.', 'type' => 'error']);
        }
    }

    private function isPendingStatus(string $status): bool
    {
        return in_array($status, [FormStatus::STATUS_PENDING], true);
    }

    private function validatePanCardData(Request $request): array
    {
        return $request->validate([
            'application_mode' => ['required', 'in:EKYC,ESIGN'],
            'application_type' => ['required', 'in:49A,CR'],
            'category' => ['required', 'in:P'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:M,F,O'],
            'mobile' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email' => ['required', 'email', 'max:255'],
            'pan_type' => ['required', 'in:Y,N'],
            'consent' => ['accepted'],
        ]);
    }

    public function destroy(PanCard $panCard)
    {
        Gate::authorize('delete', $panCard);

        try {

            if (!$this->isPendingStatus($panCard->status)) {
                throw new \Exception('The PanCard cannot be deleted as its status is not pending.');
            }

            $panCard->delete();

            return response()->json([
                'message' => 'delete success',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ]);
        }
    }

    public function print(PanCard $panCard)
    {
        Gate::authorize('view', $panCard);
        return Pdf::loadView('nsdl-pan.print', ['panCard' => $panCard])
            ->setPaper('a4')
            ->download('recept.pdf');
    }
}
