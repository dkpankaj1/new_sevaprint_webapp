<?php

namespace App\Console\Commands;

use App\Enums\FormStatus;
use App\Models\PanCard;
use Illuminate\Console\Command;

class ShowPandata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pandata:show {status?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show pan data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pandataQuery = PanCard::query();
        $pandataQuery = $this->argument('status')
            ? $pandataQuery->where(['status' => $this->argument('status')])
            : $pandataQuery;

        $pandata = $pandataQuery->select([
            "user_id",
            "unique_id",
            "order_id",
            "application_mode",
            "application_type",
            "acknowledgement_no",
            "status"
        ])->get();

        $this->table([
            "User ID",
            "Unique",
            "Order ID",
            "ApplicationMode",
            "ApplicationType",
            "AcknowledgementNo",
            "status"
        ], $pandata);
    }
}
