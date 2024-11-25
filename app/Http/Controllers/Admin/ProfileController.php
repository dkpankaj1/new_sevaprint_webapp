<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.account.index', ['admin' => $admin]);
    }
    public function profile()
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.account.profile', ['user' => $admin]);

    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique(Admin::class, 'email')
                    ->ignore(Auth::guard('admin')->user()->id)
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if ($request->hasFile('avatar')) {
                if (Auth::guard('admin')->user()->getRawOriginal('avatar')) {
                    ImageUploadHelper::deleteFile(Auth::guard('admin')->user()->getRawOriginal('avatar'));
                }
                $data['avatar'] = ImageUploadHelper::uploadImage($request->file('avatar'), 'avatar');
            }

            Auth::guard('admin')->user()->update($data);

            $notification = ['message' => 'Profile update success.!', 'type' => "success"];
            return redirect()->route('admin.account.profile.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = ['message' => 'Something went wrong.!', 'type' => "error"];
            return redirect()->route('admin.account.profile.index')->with($notification);
        }
    }

    public function password()
    {
        return view('admin.account.password');
    }
    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        try {

            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            $notification = ['message' => __('message.profile.update.success'), 'type' => "success"];
            return redirect()->route('account.profile.index')->with($notification);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $notification = ['message' => __('message.profile.update.error'), 'type' => "success"];
            return redirect()->route('account.profile.index')->with($notification);
        }

    }
}
