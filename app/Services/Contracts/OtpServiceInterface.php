<?php 

namespace App\Services\Contracts;
interface OtpServiceInterface
{
    public function generateOtp($user);
    public function verifyOtp($user, $otp);
    public function resendOtp($user);
}