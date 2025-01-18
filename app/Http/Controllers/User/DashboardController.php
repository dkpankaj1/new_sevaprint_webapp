<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $features = Feature::where(['enable' => true])->get();
        return view('dashboard', ['features' => $features]);
    }
}
