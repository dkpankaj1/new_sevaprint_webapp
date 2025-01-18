<?php

namespace App\Http\Controllers;

use App\Models\CircleCode;
use App\Models\OperatorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MobileRechargePlansController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            // Validate the request inputs
            $request->validate([
                'operator' => ['required', Rule::exists(OperatorCode::class, 'code')],
                'circle' => ['required', Rule::exists(CircleCode::class, 'code')],
            ]);

            // Fetch operator code
            $opCode = OperatorCode::where(['code' => $request->operator])->first();

            if (!$opCode) {
                return response()->json(['error' => 'Invalid operator code.'], 400);
            }

            $planFetchApi = env('PLAN_FETCH_API_URL', 'http://planapi.in/api/Mobile/NewMobilePlans');
            $apiMember_id = env('PLAN_API_MEMBER_ID', '5822');
            $apiPassword = env('PLAN_API_PASSWORD', 'Rahul@8083');

            // Make the API request using HTTPS
            $resp = Http::get($planFetchApi, [
                "apimember_id" => $apiMember_id,
                "api_password" => $apiPassword,
                "operatorcode" => $opCode->plan_api_code,
                "cricle" => $request->circle,
            ]);

            // Ensure response is valid
            $decodedResponse = json_decode($resp->body());
            Log::info('APi Response: ' . $resp->body());

            if (isset($decodedResponse->ERROR) && $decodedResponse->ERROR == 0) {
                return view('mobile-recharge.plan', [
                    'plans' => $decodedResponse->RDATA,
                    'isError' => false,
                ]);
            } else {
                return response()->json(['error' => 'Failed to fetch plans.'], 500);
            }

        } catch (\Exception $e) {
            Log::error('Error fetching mobile plans: ' . $e->getMessage());

            // Return a user-friendly error message
            return response()->json(['error' => 'An error occurred while fetching plans. Please try again later.'], 500);
        }
    }
}



