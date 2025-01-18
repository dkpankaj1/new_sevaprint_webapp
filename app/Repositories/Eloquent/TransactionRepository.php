<?php
namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\TransactionRepositoryInterface;
class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }
    public function create(array $data): Transaction
    {
        return parent::create($data);
    }
    public function find(int $id): ?Transaction
    {
        return parent::find($id);
    }
    public function delete(int $id): bool
    {
        return parent::delete($id);
    }
}