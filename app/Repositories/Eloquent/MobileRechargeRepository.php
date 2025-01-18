<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Models\MobileRecharge;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\MobileRechargeRepositoryInterface;

class MobileRechargeRepository extends BaseRepository implements MobileRechargeRepositoryInterface
{
    public function __construct(MobileRecharge $model)
    {
        parent::__construct($model);
    }
    public function query(): Builder
    {
        return MobileRecharge::query()->orderByDesc('id');
    }

    public function all(): Collection
    {
        return MobileRecharge::all();
    }
    public function find(int $id): ?MobileRecharge
    {
        return MobileRecharge::find($id);
    }
    public function create(array $data): MobileRecharge
    {
        return MobileRecharge::create($data);
    }
}