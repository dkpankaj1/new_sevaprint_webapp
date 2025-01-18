<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BalanceTransfer;
interface BalanceTransferRepositoryInterface{
    public function query(): Builder;
    public function all(): Collection;
    public function find(int $id): ?BalanceTransfer;
    public function create(array $data): BalanceTransfer;
    public function update(int $id, array $data): BalanceTransfer;
    public function delete(int $id): bool;
}