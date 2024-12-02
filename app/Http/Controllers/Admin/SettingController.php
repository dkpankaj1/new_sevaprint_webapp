<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\BrandSetting;
use App\Models\Currency;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }
    public function brandSetting()
    {
        $brandSetting = BrandSetting::first();
        return view('admin.setting.brand', ['brandSetting' => $brandSetting]);
    }
    public function updateBrandSetting(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "title" => "required|string|max:255",
            "description" => "nullable|string",
            "logo" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "logo_main" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "favicon" => "nullable|image|mimes:png|max:512",
            "contact_email" => "nullable|email|max:255",
            "contact_phone" => "nullable|string|max:20",
        ]);

        try {

            $brandSetting = BrandSetting::first();

            if ($request->hasFile('logo')) {

                ImageUploadHelper::deleteFile($brandSetting->logo);

                $brandSetting->logo = ImageUploadHelper::uploadImage(
                    $request->file('logo'),
                    'static',
                    94,
                    99
                );

            }
            if ($request->hasFile('logo_main')) {

                ImageUploadHelper::deleteFile($brandSetting->logo_main);

                $brandSetting->logo_main = ImageUploadHelper::uploadImage(
                    $request->file('logo_main'),
                    "static",
                    244,
                    68
                );

            }
            if ($request->hasFile('favicon')) {

                ImageUploadHelper::deleteFile($brandSetting->favicon);

                $brandSetting->favicon = ImageUploadHelper::uploadImage(
                    $request->file('favicon'),
                    "static",
                    32,
                    32
                );

            }

            $brandSetting->name = $request->name;
            $brandSetting->title = $request->title;
            $brandSetting->description = $request->description;
            $brandSetting->contact_email = $request->contact_email;
            $brandSetting->contact_phone = $request->contact_phone;
            $brandSetting->save();

            $notification = ['message' => 'Update success', 'type' => 'success'];
            return redirect()->route('admin.settings.index')->with($notification);
        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function generalSetting()
    {
        $generalSetting = GeneralSetting::first();
        $currencies = Currency::all();
        return view('admin.setting.general', [
            'generalSetting' => $generalSetting,
            'currencies' => $currencies,
        ]);
    }
    public function updateGeneralSetting(Request $request)
    {
        $request->validate([
            "date_format" => "required|string|in:Y-m-d,m/d/Y,d-m-Y",
            "default_currency" => ["required", Rule::exists(Currency::class, 'id')],
            "timezone" => "required|timezone",
            "maintenance_mode" => "required|boolean",
            "language" => "required|string|max:5|in:en,hi",
            "session_timeout" => "required|integer|min:1|max:1440",
            "copyright" => "nullable|string|max:255",
            "developed_by" => "nullable|string|max:255",
        ]);
        try {

            $generalSetting = GeneralSetting::first();

            $generalSetting->date_format = $request->date_format;
            $generalSetting->default_currency = $request->default_currency;
            $generalSetting->timezone = $request->timezone;
            $generalSetting->maintenance_mode = $request->maintenance_mode;
            $generalSetting->language = $request->language;
            $generalSetting->session_timeout = $request->session_timeout;
            $generalSetting->copyright = $request->copyright;
            $generalSetting->developed_by = $request->developed_by;

            $generalSetting->save();

            $notification = ['message' => 'Update success', 'type' => 'success'];
            return redirect()->route('admin.settings.index')->with($notification);
        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function emailConfigurationSetting()
    {
        $emailConfigurationSetting = EmailConfiguration::first();
        return view('admin.setting.email', ['emailConfigurationSetting' => $emailConfigurationSetting]);
    }
    public function updateEmailConfigurationSetting(Request $request)
    {
        $request->validate([
            "email_enable" => "required|boolean",
            "smtp_host" => "required|string|max:255",
            "smtp_port" => "required|integer|min:1|max:65535",
            "smtp_username" => "nullable|string|max:255",
            "smtp_password" => "nullable|string|max:255",
            "smtp_encryption" => "nullable|string|in:tls,ssl",
            "from_address" => "required|email|max:255",
            "from_name" => "required|string|max:255",
            "reply_to_address" => "nullable|email|max:255",
            "reply_to_name" => "nullable|string|max:255",
        ]);
        try {

            $emailConfigurationSetting = EmailConfiguration::first();

            $emailConfigurationSetting->email_enable = $request->email_enable;
            $emailConfigurationSetting->smtp_host = $request->smtp_host;
            $emailConfigurationSetting->smtp_port = $request->smtp_port;
            $emailConfigurationSetting->smtp_username = $request->smtp_username;
            $emailConfigurationSetting->smtp_password = $request->smtp_password;
            $emailConfigurationSetting->smtp_encryption = $request->smtp_encryption;
            $emailConfigurationSetting->from_address = $request->from_address;
            $emailConfigurationSetting->from_name = $request->from_name;
            $emailConfigurationSetting->reply_to_address = $request->reply_to_address;
            $emailConfigurationSetting->reply_to_name = $request->reply_to_name;

            $emailConfigurationSetting->save();

            $notification = ['message' => 'Update success', 'type' => 'success'];
            return redirect()->route('admin.settings.index')->with($notification);
        } catch (\Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }
}
