<?php

namespace App\Traits;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

trait RateLimiterTrait
{
    /**
     * Ensure the request is not rate-limited.
     *
     * @param Request $request
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(Request $request, string $key, int $maxAttempts = 5): void
    {
        if (!RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return;
        }

        // Pass the actual request to the Lockout event
        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Hit the rate limiter for the given key.
     */
    public function hitRateLimiter(string $key): void
    {
        RateLimiter::hit($key);
    }

    /**
     * Clear the rate limiter for the given key.
     */
    public function clearRateLimiter(string $key): void
    {
        RateLimiter::clear($key);
    }

    /**
     * Generate a throttle key for the given email and IP address.
     */
    public function generateThrottleKey(string $email, string $ip): string
    {
        return Str::transliterate(Str::lower($email) . '|' . $ip);
    }
}
