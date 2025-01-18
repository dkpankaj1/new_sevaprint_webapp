<?php

namespace App\Repositories\Contracts;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Builder;

interface FeatureRepositoryInterface
{
    public function query(): Builder;
    public function find(int $id): ?Feature;
    public function update(int $id, array $data): Feature;
}