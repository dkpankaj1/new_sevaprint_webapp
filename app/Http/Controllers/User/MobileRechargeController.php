<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\CircleCode;
use App\Models\MobileRecharge;
use App\Models\OperatorCode;
use App\Services\Contracts\MobileRechargeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MobileRechargeController extends Controller
{
    protected $mobileRechargeService;

    public function __construct(MobileRechargeServiceInterface $mobileRechargeServiceInterface)
    {
        $this->mobileRechargeService = $mobileRechargeServiceInterface;
    }
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->mobileRechargeService->getDataTableData();
        }
        return view('mobile-recharge.index');
    }
    public function create(Request $request)
    {
        $operatorType = $request->get('type');

        $query = OperatorCode::query();

        if (in_array($operatorType, ['mobile', 'dth'])) {
            $query->where('type', $operatorType);
        }

        $operators = $query->orderBy('name')->get();
        $circles = CircleCode::orderBy('name')->get();

        return view('mobile-recharge.create', [
            "operators" => $operators,
            "circles" => $circles,
            "type" => $operatorType ?? null
        ]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            "mobile_number" => ["required", "numeric"],
            "amount" => ["required", "numeric", "min:1"],
            "operator" => ["required", "string", "max:255"],
            "circle" => ["required", "string", "max:255"],
        ]);
        
        $operatorType = $request->get('type');

        $validator['type'] = in_array($operatorType, ['mobile', 'dth']) ? $operatorType : "mobile/dth";

        if (!Gate::allows('checkBalance', [(float) $validator['amount']])) {
            return back()->with(['message' => 'Low Balance', 'type' => 'error']);
        }
        try {

            $mobileRechargeResource = $this->mobileRechargeService->storeMobileRecharge($validator);
            return redirect()->route('mobile-recharge.index', $mobileRechargeResource)
                ->with(['message' => 'recharge request success.', 'type' => 'success']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => "error"]);
        }
    }
    public function show(MobileRecharge $mobileRecharge)
    {
        return view('mobile-recharge.show', ['mobileRecharge' => $mobileRecharge]);
    }
}
