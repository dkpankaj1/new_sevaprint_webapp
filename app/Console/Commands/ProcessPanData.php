<?php

namespace App\Console\Commands;

use App\Enums\FormStatus;
use App\Enums\TransactionEnum;
use App\Helpers\TransactionHelper;
use App\Models\GeneralSetting;
use App\Models\PanCard;
use App\Models\Transaction;
use App\Services\NsdlEkycService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessPanData extends Command
{
    protected $nsdkService;

    public function __construct(NsdlEkycService $nsdlEkycService)
    {
        parent::__construct(); // Call the parent constructor
        $this->nsdkService = $nsdlEkycService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pandata:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all PAN data with status "processing"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $panCardsData = PanCard::where(['status' => FormStatus::STATUS_PROCESSING])->get();
        $panCardsData = PanCard::where('status', FormStatus::STATUS_PROCESSING)
            ->where('created_at', '<', Carbon::now()->subMinutes(20))
            ->get();
        $progressBar = $this->output->createProgressBar($panCardsData->count());

        $transactionStatus = [
            'PENDING' => FormStatus::STATUS_PROCESSING,
            'SUCCESS' => FormStatus::STATUS_COMPLETE,
            'FAILED' => FormStatus::STATUS_REJECT,
            'REFUND' => FormStatus::STATUS_REFUND,
            'ERROR' => FormStatus::STATUS_REJECT,
        ];

        $progressBar->start();

        $panCardsData->each(function ($panCard) use ($progressBar, $transactionStatus) {

            Log::info(json_encode(['data' => $panCard]));
            $response = $this->nsdkService->getTransactionStatus($panCard->order_id);
            Log::info(json_encode(['response' => $response]));

            if ($response['status'] === "SUCCESS") {

                $responseData = $response['data'];

                $panCard->update([
                    'status' => $transactionStatus[$responseData['txn_status']],
                    'message' => $responseData['txn_description']
                ]);


                if ($transactionStatus[$responseData['txn_status']] === FormStatus::STATUS_REFUND) {
                    $transactionData = [
                        "user_id" => $panCard->user->id,
                        "transaction_type" => TransactionEnum::TYPE_INTERNAL,
                        "transaction_direction" => TransactionEnum::DIRECTION_CREDIT,
                        "vendor" => TransactionEnum::VENDOR_INTERNAL,
                        "transaction_id" => TransactionHelper::generateTransactionId(),
                        "opening_balance" => $panCard->user->wallet,
                        "amount" => $panCard->transaction_fee,
                        "fee" => 0,
                        "tax" => 0,
                        "closing_balance" => $panCard->user->wallet + $panCard->transaction_fee,
                        "currency_id" => GeneralSetting::value('default_currency'),
                        "payment_method" => TransactionEnum::METHOD_WALLET,
                        "metadata" => [
                            'message' => "PAN Card transaction refund",
                            'name' => $panCard->name,
                            'mobile' => $panCard->mobile,
                        ],
                        "processed_at" => now(),
                        'status' => TransactionEnum::STATUS_COMPLETE
                    ];
                    Transaction::create($transactionData);
                    $panCard->user()->increment('wallet', $panCard->transaction_fee);
                }
            }
            $progressBar->advance();
        });

        $progressBar->finish();
        $this->info("");
        $this->info('All PAN data has been processed.Finished!');
    }
}
