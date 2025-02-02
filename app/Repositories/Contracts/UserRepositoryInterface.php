<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

interface UserRepositoryInterface
{
    public function query(): Builder;
    public function all(): Collection;
    public function find(int $id): ?User;
    public function create(array $data): User;
    public function update(int $id, array $data): User;
    public function delete(int $id): bool;
    public function incrementWallet(int $id, float $amount);
    public function decrementWallet(int $id, float $amount);
}
