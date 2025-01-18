<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileRecharge;
use App\Services\Contracts\MobileRechargeServiceInterface;
use Illuminate\Http\Request;

class MobileRechargeController extends Controller
{
    protected $mobileRechargeService;
    public function __construct(MobileRechargeServiceInterface $mobileRechargeServiceInterface)
    {
        $this->mobileRechargeService = $mobileRechargeServiceInterface;

    }
    public function index(Request $request)
    {
        if($request->expectsJson()){
            return $this->mobileRechargeService->getDataTableAllData();
        }
        return view('admin.mobile-recharge.index');
    }

    public function show(MobileRecharge $mobileRecharge)
    {
        return view('admin.mobile-recharge.show',['mobileRecharge'=>$mobileRecharge]);
    }
}
