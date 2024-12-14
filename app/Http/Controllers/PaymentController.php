<?php

namespace App\Http\Controllers;

use App\Enums\TransactionEnum;
use App\Helpers\NicePeCheckSum;
use App\Models\NicePeConfiguration;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentInit()
    {

    }
    public function paymentSuccess(Request $request)
    {
    }
    public function paymentFailed(Request $request)
    {
    }

    public function phonePeRedirect(Request $request)
    {
    }
    public function razorPayRedirect(Request $request)
    {
    }
    public function nicePeRedirect(Request $request)
    {

        $status = $request->input('status');

        if ($status && $status === "SUCCESS") {

            $nicePe = NicePeConfiguration::first();
            $checksum = $request->input('checksum');
            $param = NicePeCheckSum::hashDecrypt($request->hash, $nicePe->secret_key);
            $isVerify = NicePeCheckSum::verifySignature($param, $nicePe->secret_key, $checksum);
            $decodedParam = json_decode($param);
            $transaction = Transaction::where('transaction_id', $decodedParam->orderId)->first();

            if (
                $isVerify &&
                $decodedParam->txnStatus === "TXN_SUCCESS" &&
                $transaction->status == TransactionEnum::STATUS_PENDING
            ) {
                $transaction->update([
                    'payment_method' => $decodedParam->paymentMode,
                    'status' => TransactionEnum::STATUS_COMPLETE
                ]);
                $transaction->user->increment('wallet', $decodedParam->txnAmount);
                return redirect()->route('wallet.index')->with(['message' => 'wallet recharge success!!', 'type' => 'success']);

            } else {
                return redirect()->route('wallet.index')->with(['message' => 'something went wrong!!', 'type' => 'error']);
            }
        } else {
            return redirect()->route('wallet.index')->with(['message' => 'something went wrong!!', 'type' => 'error']);
        }
    }

}
