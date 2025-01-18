<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use App\Services\Contracts\OtpServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OtpService implements OtpServiceInterface
{
    const OTP_VALIDITY_MINUTES = 5;
    const OTP_LENGTH = 6;
    const MAX_OTP_PER_DAY = 5;
    const OTP_SEND_COOLDOWN_SECONDS = 60;

    public function generateOtp($user)
    {
        $this->checkRateLimit($user);
        $otpCode = $this->generateOtpCode(self::OTP_LENGTH);
        $otp = Otp::create([
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(self::OTP_VALIDITY_MINUTES),
        ]);
        // Optionally send OTP via SMS, Email, etc.
        Log::info("Generated OTP for user ID {$user->id}: {$otpCode}");
        return $otp;
    }

    public function verifyOtp($user, $otpCode)
    {
        $otp = Otp::where('user_id', $user->id)
            ->where('otp_code', $otpCode)
            ->where('expires_at', '>', Carbon::now())
            ->where('is_used', false)
            ->first();
        if ($otp) {
            $otp->update(['is_used' => true]);
            return true;
        }
        return false;
    }

    public function resendOtp($user)
    {
        return $this->generateOtp($user);
    }

    private function generateOtpCode($length)
    {
        return str_pad(random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    private function checkRateLimit($user)
    {
        // Check for cooldown (1 OTP per minute)
        $lastOtp = Otp::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastOtp && $lastOtp->created_at->diffInSeconds(Carbon::now()) < self::OTP_SEND_COOLDOWN_SECONDS) {
            throw new \Exception("Please wait at least 1 minute before requesting a new OTP.");
        }

        // Check daily limit (5 OTPs per day)
        $todayOtpCount = Otp::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($todayOtpCount >= self::MAX_OTP_PER_DAY) {
            throw new \Exception("You have reached the maximum OTP request limit for today.");
        }
    }
}
