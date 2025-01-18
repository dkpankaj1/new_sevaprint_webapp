<?php 
namespace App\Http\Controllers\Api\Auth;

;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use ApiResponse;

    public function store(Request $request)
    {
        // Custom validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors()->toArray());
        }

        // Attempt authentication
        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->unauthorizedResponse('Invalid login details');
        }

        if (Auth::user()->currentAccessToken()) {
            Auth::user()->currentAccessToken()->delete();
        }

        // Generate token
        $token = Auth::user()->createToken('api_token')->plainTextToken;

        return $this->successResponse([
            'user'=>auth()->user(),
            'token' => $token
        ], 'Login successful');
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse([], 'Logged out successfully');
    }
}
