<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $userQuery = User::query();
            return DataTables::eloquent($userQuery)
                ->addIndexColumn()
                ->addColumn('status', fn($user) => $user->is_active == 1 ? "active" : "in-active")
                ->addColumn('avatar', fn($user) => view('components.user-avatar', ['src' => $user->avatar]))
                ->addColumn('action', function ($user) {
                    return view('components.show-btn', ['url' => "#!"]);
                })
                ->make(true);
        }

        return view('admin.users.index');
    }
}
