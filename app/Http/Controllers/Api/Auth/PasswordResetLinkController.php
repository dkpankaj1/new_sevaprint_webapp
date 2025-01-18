<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PasswordResetLinkController extends Controller
{
    use ApiResponse;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email',Rule::exists(User::class,'email')],
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors()->toArray());
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return ($status == Password::RESET_LINK_SENT)
            ?  $this->successResponse([], 'A password reset link has been sent to your email address.')
            : $this->errorResponse('We were unable to send a password reset link. Please try again later.');

    }
}
