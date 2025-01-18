<?php

namespace App\Services;

use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    protected $transactionRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(TransactionRepositoryInterface $transactionRepositoryInterface)
    {
        $this->transactionRepository = $transactionRepositoryInterface;
    }
    public function create($data){
        return $this->transactionRepository->create($data);
    }
}
