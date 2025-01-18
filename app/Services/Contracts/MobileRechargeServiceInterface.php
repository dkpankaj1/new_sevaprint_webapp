<?php
namespace App\Services\Contracts;
use App\Models\MobileRecharge;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
interface MobileRechargeServiceInterface
{
    public function getDataTableData(): JsonResponse;
    public function getDataTableAllData(): JsonResponse;
    public function getAllMobileRecharge(): Collection;
    public function storeMobileRecharge(array $data): MobileRecharge;
    public function showMobileRecharge(int $id): ?MobileRecharge;

}