<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Models\UserService;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserServiceRepositoryInterface;

class UserServiceRepository extends BaseRepository implements UserServiceRepositoryInterface
{
    public function __construct(UserService $model)
    {
        parent::__construct($model);
    }
    public function getUserServiceCharges(int $userId): array
    {
        $customCharges = $this->model->where('user_id', $userId)
            ->with('service')
            ->get();

        $customChargesMapped = $customCharges->map(function ($charge) {
            return [
                'service_code' => $charge->service->code,
                'service_name' => $charge->service->name,
                'charge' => $charge->custom_charge,
            ];
        })->toArray();

        $defaultCharges = Service::whereNotIn('id', $customCharges->pluck('service_id'))
            ->get()
            ->map(function ($service) {
                return [
                    'service_code' => $service->code,
                    'service_name' => $service->name,
                    'charge' => $service->fee,
                ];
            })->toArray();

        return array_merge($customChargesMapped, $defaultCharges);
    }

    public function calculateCharge(int $userId, string $serviceCode): float
    {
        $service = Service::where('code', $serviceCode)->first();

        if (!$service) {
            throw new \Exception("Service with code '{$serviceCode}' not found.");
        }

        $customCharge = $this->model->where('user_id', $userId)
            ->where('service_id', $service->id)
            ->value('custom_charge');

        return $customCharge !== null ? $customCharge : $service->fee;
    }
}