<?php

namespace App\Repositories\Contracts;

interface UserServiceRepositoryInterface
{
    public function getUserServiceCharges(int $userId): array;

    public function calculateCharge(int $userId, string $serviceCode): float;
}