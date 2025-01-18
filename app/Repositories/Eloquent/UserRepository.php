<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function find(int $id): ?User
    {
        return parent::find($id);
    }

    public function create(array $data): User
    {
        return parent::create($data);
    }

    public function update(int $id, array $data): User
    {
        return parent::update($id, $data);
    }

    public function incrementWallet($userId, $amount)
    {
        return User::where('id', $userId)->increment('wallet', $amount);
    }

    public function decrementWallet($userId, $amount)
    {
        return User::where('id', $userId)->decrement('wallet', $amount);
    }

}