<?php 

namespace App\Repositories\Contracts;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
interface TransactionRepositoryInterface{
    public function query(): Builder;
    public function all(): Collection;
    public function find(int $id): ?Transaction;
    public function create(array $data): Transaction;
    public function delete(int $id): bool;
}