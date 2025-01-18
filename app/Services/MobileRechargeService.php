<?php

namespace App\Services;


use App\Enums\MobileRechargeEnums;
use App\Enums\TransactionEnum;
use App\Helpers\RechargeHelper;
use App\Helpers\TransactionHelper;
use App\Models\GeneralSetting;
use App\Models\MobileRecharge;
use App\Models\User;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\MobileRechargeRepository;
use App\Services\Contracts\MobileRechargeServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MobileRechargeService implements MobileRechargeServiceInterface
{
    protected $mobileRechargeRepository;
    protected $transactionRepository;
    protected $userRepository;
    public function __construct(
        MobileRechargeRepository $mobileRechargeRepository,
        TransactionRepositoryInterface $transactionRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->mobileRechargeRepository = $mobileRechargeRepository;
        $this->transactionRepository = $transactionRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
    }
    public function getDataTableData(): JsonResponse
    {
        $query = $this->mobileRechargeRepository->query()
        ->where('user_id',Auth::id());

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function ($transaction) {
                $badgeType = match ($transaction->status) {
                    'complete' => 'success',
                    'pending' => 'info',
                    'failed' => 'danger',
                    default => 'secondary',
                };
                return view('components.badges', [
                    'type' => $badgeType,
                    'text' => ucfirst($transaction->status),
                ]);
            })
            ->addColumn('amount', function ($data) {
                return "{$data->currency->code} {$data->amount}";
            })
            ->addColumn('created_at', function ($data) {
                return $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('action', function ($data) {
                return view('components.show-btn', ['url' => route('mobile-recharge.show', $data->id)]);
            })
            ->make(true);
    }

    public function getDataTableAllData(): JsonResponse
    {
        $query = $this->mobileRechargeRepository->query();
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function ($transaction) {
                $badgeType = match ($transaction->status) {
                    'complete' => 'success',
                    'pending' => 'info',
                    'failed' => 'danger',
                    default => 'secondary',
                };
                return view('components.badges', [
                    'type' => $badgeType,
                    'text' => ucfirst($transaction->status),
                ]);
            })
            ->addColumn('amount', function ($data) {
                return "{$data->currency->code} {$data->amount}";
            })
            ->addColumn('created_at', function ($data) {
                return $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('action', function ($data) {
                return view('components.show-btn', ['url' => route('admin.mobile-recharge.show', $data->id)]);
            })
            ->make(true);
    }
    public function getAllMobileRecharge(): Collection
    {
        return $this->mobileRechargeRepository->all();
    }
    public function storeMobileRecharge($data): MobileRecharge
    {
        $user = $this->userRepository->find(Auth::id());

        $roboticExchangeService = new RoboticExchangeService();

        $defaultCurrency = GeneralSetting::value('default_currency');
        $uniqid = RechargeHelper::generateOrderId();

        $mobileRechargeResource = $this->mobileRechargeRepository->create([
            "uniqid" => $uniqid,
            "user_id" => $user->id,
            "mobile_number" => $data['mobile_number'],
            "currency_id" => $defaultCurrency,
            "amount" => $data['amount'],
            "operator" => $data['operator'],
            "circle" => $data['circle'],
            'type' => $data['type'],
            "status" => MobileRechargeEnums::STATUS_PENDING,
        ]);

        $response = $roboticExchangeService->mobileRecharge(
            $data['mobile_number'],
            $data['operator'],
            $data['amount'],
            $uniqid,
            $data['circle']
        );

        $transactionData = [
            "user_id" => $user->id,
            "transaction_type" => TransactionEnum::TYPE_INTERNAL,
            "transaction_direction" => TransactionEnum::DIRECTION_DEBIT,
            "vendor" => TransactionEnum::VENDOR_INTERNAL,
            "transaction_id" => TransactionHelper::generateTransactionId(),
            "opening_balance" => $user->wallet,
            "amount" => $data['amount'],
            "fee" => 0,
            "tax" => 0,
            "closing_balance" => $user->wallet - $data['amount'],
            "currency_id" => $defaultCurrency,
            "payment_method" => TransactionEnum::METHOD_WALLET,
            "metadata" => [
                'message' => "new recharge transaction",
                'mobile' => $data['mobile_number'],
                'operator' => $data['operator'],
                'circle' => $data['circle'],
            ],
            "ip_address" => request()->ip(),
            "user_agent" => request()->userAgent(),
            "processed_at" => now(),
        ];

        if ($response['error']) {
            $this->transactionRepository->create(array_merge($transactionData, ['status' => TransactionEnum::STATUS_FAILED]));
            $mobileRechargeResource->update(['status' => MobileRechargeEnums::STATUS_FAILED]);
            return $mobileRechargeResource;
        }

        $responseData = $response['data'];
        if ($responseData['ERROR'] == 0 && $responseData['STATUS'] == 1) {
            $this->transactionRepository->create(array_merge($transactionData, ['status' => TransactionEnum::STATUS_COMPLETE]));
            $this->userRepository->decrementWallet($user->id, $data['amount']);
            $mobileRechargeResource->update([
                'status' => MobileRechargeEnums::STATUS_COMPLETE,
                'recharged_at' => now(),
            ]);
        } else {
            $this->transactionRepository->create(array_merge($transactionData, ['status' => TransactionEnum::STATUS_FAILED]));
            $mobileRechargeResource->update(['status' => MobileRechargeEnums::STATUS_FAILED]);
        }

        return $mobileRechargeResource;
    }

    public function showMobileRecharge($id): ?MobileRecharge
    {
        return $this->mobileRechargeRepository->find($id);
    }
}