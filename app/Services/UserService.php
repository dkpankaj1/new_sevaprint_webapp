<?php
namespace App\Services;

use App\Models\GeneralSetting;
use App\Repositories\Contracts\UserRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function getDataTableData()
    {
        $generalSetting = GeneralSetting::first();

        return DataTables::eloquent($this->userRepository->query()->orderBy('id', 'desc'))
            ->addIndexColumn()

            ->addColumn('status', fn($user) => $user->is_active == 1
                ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

            ->addColumn('wallet', function ($user) use ($generalSetting) {
                $currencySymbol = $generalSetting->currency->symbol ?? '';
                $walletAmount = number_format($user->wallet, 2);
                return "{$currencySymbol} {$walletAmount}";
            })

            ->addColumn('avatar', fn($user) => view('components.user-avatar', ['src' => $user->avatar]))

            ->addColumn('action', function ($user) {
                return view('components.show-btn', ['url' => route('admin.users.show', $user->id)]) .
                    view('components.edit-btn', ['url' => route('admin.users.edit', $user->id)]) .
                    view('components.delete-btn', ['url' => route('admin.users.destroy', $user->id)]);
            })

            ->make(true);
    }
    public function find($id)
    {
        return $this->userRepository->find($id);
    }
    public function create($data)
    {
        return $this->userRepository->create($data);
    }
}