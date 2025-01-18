<?php

namespace App\Http\Controllers\User;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ServiceChargeCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        return view('account.index', ['user' => $user]);
    }
    public function profile(Request $request)
    {
        $user = User::find($request->user()->id);
        return view('account.profile', ['user' => $user]);
    }
    public function profileUpdate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // optional avatar image
                'is_active' => 'boolean', // expects 0 or 1
            ]);

            if ($request->hasFile('avatar')) {

                if ($request->user()->getRawOriginal('avatar')) {
                    ImageUploadHelper::deleteFile($request->user()->getRawOriginal('avatar'));
                }
                
                $avatarPath = ImageUploadHelper::uploadImage($request->file('avatar'), 'avatar');
                $request->user()->avatar = $avatarPath;
            }

            $request->user()->fill($request->except(['avatar']));
            $request->user()->save();

            $notification = ['message' => __('message.profile.update.success'), 'type' => "success"];
            return redirect()->route('account.profile.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = ['message' => __('message.profile.update.error'), 'type' => "error"];
            return redirect()->route('account.profile.index')->with($notification);
        }
    }
    public function password()
    {
        return view('account.password');
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
            Log::error($e->getMessage());
            $notification = ['message' => __('message.profile.update.error'), 'type' => "error"];
            return redirect()->route('account.profile.index')->with($notification);
        }

    }

    public function charges(){

        
        // return view('account.charges',['charges' => $charges]);
    }
}
