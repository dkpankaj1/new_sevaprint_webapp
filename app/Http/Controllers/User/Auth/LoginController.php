<?php

namespace App\Http\Controllers\User\Auth;

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
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        $key = $this->generateThrottleKey($request->input('email'), $request->ip());
        $this->ensureIsNotRateLimited($request, $key);
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true], $request->boolean('remember'))) {
            $this->hitRateLimiter($key);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        $this->clearRateLimiter($key);
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
