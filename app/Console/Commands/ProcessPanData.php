<?php

namespace App\Console\Commands;

use App\Enums\FormStatus;
use App\Models\PanCard;
use App\Services\NsdlEkycService;
use Illuminate\Console\Command;
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
        $pandata = PanCard::where(['status' => FormStatus::STATUS_PROCESSING])->get();
        $progressBar = $this->output->createProgressBar($pandata->count());

        $transactionStatus = [
            'SUCCESS' => FormStatus::STATUS_COMPLETE,
            'FAILED' => FormStatus::STATUS_REJECT,
            'REFUND' => FormStatus::STATUS_REFUND,
            'ERROR' => FormStatus::STATUS_REJECT,            
        ];

        $progressBar->start();

        $pandata->each(function ($data) use ($progressBar,$transactionStatus) {
            Log::info(json_encode($data));
            $response = $this->nsdkService->getTransactionStatus($data->order_id);
            
            if ($response['status'] === "SUCCESS") {

                $responseData = $response['data'];

                $panCard = PanCard::find($data->id)->update([
                    'status' => $transactionStatus[$responseData['txn_status']],
                    'message'=> $responseData['txn_description']
                ]);

                if($panCard->status !== FormStatus::STATUS_COMPLETE){
                    $panCard->user()->increment('wallet', $panCard->transaction_fee);
                }
            }

            Log::info(json_encode($response));
            $progressBar->advance();
        });

        $progressBar->finish();
        $this->info("");
        $this->info('All PAN data has been processed.Finished!');
    }
}
