<?php

namespace App\Repositories\Contracts;

use App\Models\MobileRecharge;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface MobileRechargeRepositoryInterface
{
    public function query(): Builder;

    public function all(): Collection;

    public function find(int $id): ?MobileRecharge;

    public function create(array $data): MobileRecharge;
}