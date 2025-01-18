<?php

namespace App\Services\Contracts;

use App\Models\BalanceTransfer;
use Illuminate\Http\JsonResponse;
interface BalanceTransferServiceInterface
{
    public function getDataTableData(): JsonResponse;
    public function storeBalanceTransfer(array $data): ?BalanceTransfer;
    public function updateBalanceTransfer(array $data, BalanceTransfer $balanceTransfer): ?BalanceTransfer;
}