<?php

namespace App\Http\Controllers\User;

use App\Enums\TransactionEnum;
use App\Helpers\NicePeCheckSum;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\NicePeConfiguration;
use App\Models\PhonePeConfiguration;
use App\Models\RazorPayConfiguration;
use App\Models\Transaction;
;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    protected $generalSetting;

    public function __construct()
    {
        $this->generalSetting = GeneralSetting::first();
    }
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $transactionsQuery = Transaction::query()->where('user_id', $request->user()->id)
                ->whereNot('status', TransactionEnum::STATUS_PENDING)
                ->orderBy('id', 'desc');

            return DataTables::eloquent($transactionsQuery)
                ->addIndexColumn()
                ->addColumn('transaction_direction', fn($transaction) => ucfirst($transaction->transaction_direction))
                ->addColumn('opening_balance', function ($transaction) {
                    return "{$transaction->currency->code} {$transaction->opening_balance}";
                })
                ->addColumn('amount', function ($transaction) {
                    return "{$transaction->currency->code} {$transaction->amount}";
                })
                ->addColumn('fee', function ($transaction) {
                    return "{$transaction->currency->code} {$transaction->fee}";
                })
                ->addColumn('tax', function ($transaction) {
                    return "{$transaction->tax} (%)";
                })
                ->addColumn('closing_balance', function ($transaction) {
                    return "{$transaction->currency->code} {$transaction->closing_balance}";
                })
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
                ->make(true);
        }

        return view('wallet.index');
    }

    public function recharge()
    {
        $phonePePG = PhonePeConfiguration::first();
        $razorPeyPG = RazorPayConfiguration::first();
        $nicePePG = NicePeConfiguration::first();
        return view(
            'wallet.recharge',
            [
                'phonePePG' => $phonePePG,
                'razorPeyPG' => $razorPeyPG,
                'nicePePG' => $nicePePG,
            ]
        );

    }

    public function rechargeProcess(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0', 'max:5000'],
            'vendor' => ['required', Rule::in(['phonepe', 'razorpey', 'nicepe'])]
        ]);

        try {
            $vendor = $request->vendor;
            $user = Auth::user();
            $transaction = new Transaction();

            $transaction->user_id = $user->id;
            $transaction->transaction_type = TransactionEnum::TYPE_EXTERNAL;
            $transaction->transaction_direction = TransactionEnum::DIRECTION_CREDIT;
            $transaction->transaction_id = TransactionHelper::generateTransactionId();
            $transaction->opening_balance = $user->wallet;
            $transaction->amount = $validated['amount'];
            $transaction->fee = 0;
            $transaction->tax = 0;
            $transaction->closing_balance = $user->wallet + $validated['amount'];
            $transaction->currency_id = TransactionHelper::getCurrency()->id;
            $transaction->payment_method = TransactionEnum::METHOD_WALLET;
            $transaction->status = TransactionEnum::STATUS_PENDING;
            $transaction->metadata = ['message' => "wallet recharge by admin"];
            $transaction->ip_address = $request->ip();
            $transaction->user_agent = $request->userAgent();

            if ($vendor === "phonepe") {
                $transaction->vendor = TransactionEnum::VENDOR_PHONEPE;
                $transaction->save();

            }
            if ($vendor === "razorpey") {
                $transaction->vendor = TransactionEnum::VENDOR_RAZORPAY;
                $transaction->save();

            }
            if ($vendor === "nicepe") {
                $transaction->vendor = TransactionEnum::VENDOR_NICEPE;
                $transaction->save();
                return $this->nicePePaymentPage($transaction);
            }

            abort(404);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => "error"]);
        }
    }

    public function phonePePaymentPage(Request $request)
    {

    }
    public function razorPayPaymentPage(Request $request)
    {

    }
    public function nicePePaymentPage(Transaction $transaction)
    {
        $nicePe = NicePeConfiguration::first();


        $uipId = $nicePe->upi_id;
        $secretKey = $nicePe->secret_key;
        $token = $nicePe->token;
        $base_url = $nicePe->base_url;

        $callbackUrl = route('payment.nicepe.redirect');

        $transactionData = [
            'upiuid' => $uipId,
            'token' => $token,
            'orderId' => $transaction->transaction_id,
            'txnAmount' => $transaction->amount,
            'txnNote' => 'no notes',
            "cust_Email" => $transaction->user->email,
            "cust_Mobile" => $transaction->user->phone,
            'callback_url' => $callbackUrl,
        ];

        $checksum = NicePeCheckSum::generateSignature($transactionData, $secretKey);

        \Log::info(json_encode(['checksum' => $checksum]));
        \Log::info(json_encode($transactionData));

        return view('payment.nicepe', ['transactionData' => $transactionData, 'checksum' => $checksum, 'baseUrl' => $base_url]);
    }
}
