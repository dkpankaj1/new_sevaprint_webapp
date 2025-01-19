<?php
namespace App\Http\Controllers\Admin;

use App\Enums\TransactionEnum;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $sevenDaysAgo = Carbon::today()->subDays(7);

        // Generate date range for the past 7 days
        $dateRange = collect(range(0, 7))->mapWithKeys(function ($day) use ($sevenDaysAgo) {
            $date = $sevenDaysAgo->copy()->addDays($day)->format('Y-m-d');
            return [$date => 0]; // Initialize with zero
        });

        // Fetch grouped transactions
        $debitTransactions = $this->fetchGroupedTransactions(TransactionEnum::DIRECTION_DEBIT, $sevenDaysAgo, $today);
        $creditTransactions = $this->fetchGroupedTransactions(TransactionEnum::DIRECTION_CREDIT, $sevenDaysAgo, $today);

        // Merge with date range to fill missing dates
        $debit = $dateRange->merge($debitTransactions);
        $credit = $dateRange->merge($creditTransactions);

        return view('admin.dashboard', [
            "debit" => $debit->values(), // Pass values as array
            "credit" => $credit->values(),
            "dates" => $dateRange->keys(), // Pass categories (dates)
        ]);
    }

    /**
     * Fetch transactions grouped by date.
     *
     * @param string $direction
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return \Illuminate\Support\Collection
     */
    private function fetchGroupedTransactions(string $direction, Carbon $startDate, Carbon $endDate)
    {
        return Transaction::where('transaction_direction', $direction)
            ->whereBetween('created_at', [$startDate, $endDate->endOfDay()])
            ->selectRaw('DATE(created_at) as transaction_date, SUM(amount) as total_amount')
            ->groupBy('transaction_date')
            ->pluck('total_amount', 'transaction_date');
    }
}
