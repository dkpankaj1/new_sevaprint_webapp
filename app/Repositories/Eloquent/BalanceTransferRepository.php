<?php

namespace App\Repositories\Eloquent;

use App\Models\BalanceTransfer;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\BalanceTransferRepositoryInterface;

class BalanceTransferRepository extends BaseRepository implements BalanceTransferRepositoryInterface
{
    public function __construct(BalanceTransfer $balanceTransfer)
    {
        parent::__construct($balanceTransfer);
    }

    public function find(int $id): ?BalanceTransfer
    {
        return parent::find($id);
    }
    public function create(array $data): BalanceTransfer
    {
        return parent::create($data);
    }
    public function update(int $id, array $data): BalanceTransfer
    {
        return parent::update($id, $data);
    }
    public function delete(int $id): bool
    {
        return parent::delete($id);
    }
}