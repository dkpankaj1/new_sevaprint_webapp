<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switchLanguage($locale): RedirectResponse
    {
        if (in_array($locale, ['en', 'hi'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
