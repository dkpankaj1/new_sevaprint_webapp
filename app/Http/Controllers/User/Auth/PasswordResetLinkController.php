<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $notification = ($status == Password::RESET_LINK_SENT)
            ? ['message' => __('A password reset link has been sent to your email address.'), 'alert-type' => 'success']
            : ['message' => __('We were unable to send a password reset link. Please try again later.'), 'alert-type' => 'error'];

        return redirect()->back()->with($notification);
    }

}
