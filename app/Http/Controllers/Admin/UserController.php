<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $userQuery = User::query()->orderBy('id', 'desc');
            return DataTables::eloquent($userQuery)
                ->addIndexColumn()
                ->addColumn('status', fn($user) => $user->is_active == 1
                    ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                    : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))
                ->addColumn('avatar', fn($user) => view('components.user-avatar', ['src' => $user->avatar]))
                ->addColumn('action', function ($user) {
                    return view('components.show-btn', ['url' => route('admin.users.show', $user->id)]) .
                        view('components.edit-btn', ['url' => route('admin.users.edit', $user->id)]) .
                        view('components.delete-btn', ['url' => route('admin.users.destroy', $user->id)]);
                })
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show(User $user)
    {

        return view('admin.users.show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'wallet' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->postal_code = $request->postal_code;
            $user->wallet = $request->wallet ?? 0;
            $user->is_active = $request->is_active;
            $user->save();

            $notification = ['message' => 'Create Success.', 'type' => 'success'];
            return redirect()->route('admin.users.index')->with($notification);

        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->postal_code = $request->postal_code;
            $user->is_active = $request->is_active;
            $user->save();

            $notification = ['message' => 'Update Success.', 'type' => 'success'];
            return redirect()->route('admin.users.index')->with($notification);

        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->is_active = false;
            $user->save();
            $notification = ['message' => 'user de-activate.', 'status' => 'success'];
        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'status' => 'error'];
        }

        return response()->json($notification);
    }
}
