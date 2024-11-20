<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
