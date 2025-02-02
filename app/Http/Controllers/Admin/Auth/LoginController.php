<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Traits\RateLimiterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use RateLimiterTrait;
    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $key = $this->generateThrottleKey($request->input('email'), $request->ip());
        $this->ensureIsNotRateLimited($request, $key);
        if (!Auth::guard('admin')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $this->hitRateLimiter($key);
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        $this->clearRateLimiter($key);
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }
}
