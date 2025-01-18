<?php
namespace App\Http\Controllers\User;

use App\Enums\FormStatus;
use App\Helpers\PanCardHelper;
use App\Http\Controllers\Controller;
use App\Models\PanCard;
use App\Services\NsdlEkycService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NsdlController extends Controller
{
    protected $nsdlService;
    public function __construct(NsdlEkycService $nsdlEkycService)
    {
        $this->nsdlService = $nsdlEkycService;
    }
    public function tnxStatus()
    {
        return view('nsdl-pan.tnx-status', [
            'txnStatus' => null
        ]);
    }
    public function txnStatusProcess(Request $request)
    {
        $request->validate(['order_id' => ['required']]);

        try {
            $response = $this->nsdlService->getTransactionStatus($request->order_id);
            return view('nsdl-pan.tnx-status', [
                'txnStatus' => $response
            ]);

        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with([
                'message' => 'An error occurred while processing your request.',
                'type' => 'error',
            ]);
        }
    }
    public function panStatus()
    {
        return view('nsdl-pan.status', ['panStatus' => null]);
    }
    public function panStatusProcess(Request $request)
    {
        $request->validate(['ack_no' => ['required']]);

        try {
            $response = $this->nsdlService->getPanStatus($request->ack_no);
            return view('nsdl-pan.status', ['panStatus' => $response]);

        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with([
                'message' => 'An error occurred while processing your request.',
                'type' => 'error',
            ]);
        }
    }
    public function process(Request $request, PanCard $panCard)
    {
        try {
            // Validate PanCard ownership and status
            $this->validatePanCard($panCard, $request->user()->id);

            // Redirect if already authorized
            if ($panCard->authorization) {
                return $this->redirectToNSDL($panCard->application_type, $panCard->authorization, true);
            }

            // Prepare data for NSDL authorization
            $data = $this->prepareNSDLData($panCard);
            $response = $this->nsdlService->getAuthorization($data);

            if ($response['status'] === "SUCCESS") {
                $this->updatePanCardWithSuccessResponse($panCard, $response);
                return $this->redirectToNSDL($panCard->application_type, $response['data']['authorization']);
            }

            // Handle failure response
            $this->handleFailureResponse($panCard, $response);
            return redirect()->back()->with(['message' => 'Something went wrong. Please try again.', 'type' => 'error']);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with([
                'message' => 'An error occurred while processing your request.',
                'type' => 'error',
            ]);
        }
    }

    /**
     * Validate the PanCard ownership and status.
     */
    private function validatePanCard(PanCard $panCard, $userId)
    {
        if (
            !$panCard ||
            $panCard->user_id !== $userId ||
            in_array($panCard->status, [FormStatus::STATUS_COMPLETE, FormStatus::STATUS_REJECT])
        ) {
            throw new \Exception('Unauthorized access or invalid PanCard status.');
        }
    }

    /**
     * Redirect to NSDL with the required parameters.
     */
    private function redirectToNSDL($type, $authorization, $isIncomplete = false)
    {
        $url = "https://sso-nsdl-ekyc-app.pages.dev/sso_nsdl_ekyc_redirect" .
            "?type=$type&authorization=$authorization" .
            ($isIncomplete ? "&is_incomplete=true" : "");

        return view('nsdl-pan.redirect', ['url' => $url]);
    }

    /**
     * Prepare data for NSDL authorization.
     */
    private function prepareNSDLData(PanCard $panCard)
    {
        return [
            "application_mode" => $panCard->application_mode,
            "application_type" => $panCard->application_type,
            "category" => $panCard->category,
            "branch_code" => $panCard->branch_code,
            "name" => $panCard->name,
            "gender" => $panCard->gender,
            "mobile" => $panCard->mobile,
            "email" => $panCard->email,
            "is_physical_pan_required" => $panCard->pan_type,
            "consent" => $panCard->consent,
            "redirect_url" => route('nsdl.response', $panCard),
            "p_order_id" => $panCard->unique_id,
        ];
    }

    /**
     * Update PanCard details with the successful NSDL response.
     */
    private function updatePanCardWithSuccessResponse(PanCard $panCard, array $response)
    {
        $panCard->update([
            'message' => $response['message'],
            'order_id' => $response['data']['order_id'],
            'authorization' => $response['data']['authorization'],
            'authorization_at' => now(),
            'status' => FormStatus::STATUS_PROCESSING,
        ]);
    }

    /**
     * Handle failure response from NSDL.
     */
    private function handleFailureResponse(PanCard $panCard, array $response)
    {
        Log::error(json_encode($response));
        $panCard->update(['message' => $response['message']]);
    }

    public function response(Request $request)
    {
        $encData = $request->input('encrypted_data') ?? "";
        Log::info(json_encode($encData));

        try {

            if (!$encData) {
                throw new \Exception('Unauthorized access or invalid request.');
            }

            $data = $this->decryptResponse($encData, $this->nsdlService->getEncryptionKey());

            Log::info(json_encode(['data' => $data]));

            // return redirect()->back()->with(['message' => "something went wrong. please try again.", 'type' => 'error']);

        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with([
                'message' => 'An error occurred while processing your request.',
                'type' => 'error',
            ]);
        }

    }
    public function decryptResponse(string $encrypted, string $passphrase): ?string
    {
        $encrypted = base64_decode($encrypted);
        if (substr($encrypted, 0, 8) !== 'Salted ') {
            return null;
        }

        $salt = substr($encrypted, 8, 8);
        $encrypted = substr($encrypted, 16);

        $salted = $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx . $passphrase . $salt, true);
            $salted .= $dx;
        }

        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);

        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, true, $iv);
    }
    public function webhook(Request $request)
    {


    }
}
