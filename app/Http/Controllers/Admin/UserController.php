<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $generalSetting = GeneralSetting::first();

        if ($request->expectsJson()) {
            $userQuery = User::query()->orderBy('id', 'desc');
            return DataTables::eloquent($userQuery)
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

        return view('admin.users.index');
    }

    public function create()
    {
        $country = Country::with('states')->where('code', 'IND')->first();
        return view('admin.users.create', compact('country'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        try {
            $data['password'] = Hash::make($data['password']);
            $data['wallet'] = 0;

            User::create($data);

            return redirect()->route('admin.users.index')->with([
                'message' => 'User created successfully.',
                'type' => 'success',
            ]);

        } catch (\Exception $e) {
            Log::error('User creation error: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'An error occurred. Please try again.',
                'type' => 'error',
            ]);
        }
    }

    public function edit(User $user)
    {
        $country = Country::with('states')->where('code', 'IND')->first();
        return view('admin.users.edit', compact('user', 'country'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate($this->rules($user->id));

        try {
            $user->update($data);

            return redirect()->route('admin.users.index')->with([
                'message' => 'User updated successfully.',
                'type' => 'success',
            ]);

        } catch (\Exception $e) {
            Log::error('User update error: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'An error occurred. Please try again.',
                'type' => 'error',
            ]);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->update(['is_active' => false]);

            return response()->json([
                'message' => 'User deactivated successfully.',
                'status' => 'success',
            ]);

        } catch (\Exception $e) {
            Log::error('User deletion error: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'status' => 'error',
            ]);
        }
    }

    /**
     * Get validation rules for storing/updating users.
     *
     * @param  int|null  $userId
     * @return array
     */
    private function rules($userId = null)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => $userId ? 'nullable' : ['required', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'wallet' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
        ];
    }
}
