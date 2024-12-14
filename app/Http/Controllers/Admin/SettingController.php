<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\BrandSetting;
use App\Models\Currency;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\NicePeConfiguration;
use App\Models\PhonePeConfiguration;
use App\Models\RazorPayConfiguration;
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

    public function paymentGetawaySetting()
    {
        return view('admin.setting.payment', [
            "phonePe" => PhonePeConfiguration::first(),
            "razorPe" => RazorPayConfiguration::first(),
            "nicePe" => NicePeConfiguration::first(),
        ]);
    }
    public function updatePaymentGetawaySetting(Request $request)
    {
        $getaway = $request->input('getaway');

        if ($getaway === "phonepe") {
            $request->validate([
                // 'phonepe_name' => 'required|string|max:255',
                'phonepe_description' => 'nullable|string',
                'phonepe_logo' => 'nullable|image|max:2048', // Assuming the logo is an image upload
                'phonepe_merchant_id' => 'required|string|max:100',
                'phonepe_salt_key' => 'required|string|max:100',
                'phonepe_salt_index' => 'required|integer',
                'phonepe_enable' => 'required|boolean',
            ]);

            $phonePe = PhonePeConfiguration::first();

            if ($request->hasFile('phonepe_logo')) {
                ImageUploadHelper::deleteFile($phonePe->logo);
                $phonePe->logo = ImageUploadHelper::uploadImage(
                    $request->file('phonepe_logo'),
                    'static'
                );
            }

            // $phonePe->name = $request->phonepe_name;
            $phonePe->name = 'phonepe';
            $phonePe->description = $request->phonepe_description;
            $phonePe->merchant_id = $request->phonepe_merchant_id;
            $phonePe->salt_key = $request->phonepe_salt_key;
            $phonePe->salt_index = $request->phonepe_salt_index;
            $phonePe->enable = $request->phonepe_enable;
            $phonePe->save();

            $notification = ['message' => "phonePe configuration update success", "type" => "success"];
            return redirect()->back()->with($notification);
        } elseif ($getaway === "razorpey") {
            $request->validate([
                // 'razorpay_name' => 'required|string|max:255',
                'razorpay_description' => 'nullable|string',
                'razorpay_logo' => 'nullable|image|max:2048',
                'razorpay_api_key' => 'required|string|max:100',
                'razorpay_api_secret' => 'required|string|max:100',
                'razorpay_webhook_secret' => 'required|string|max:100',
                'razorpay_enable' => 'required|boolean',
            ]);

            $razorPay = RazorPayConfiguration::first();
            if ($request->hasFile('razorpay_logo')) {
                ImageUploadHelper::deleteFile($razorPay->logo);
                $razorPay->logo = ImageUploadHelper::uploadImage(
                    $request->file('razorpay_logo'),
                    'static'
                );
            }
            // $razorPay->name = $request->razorpay_name;
            $razorPay->name = 'razorpey';
            $razorPay->description = $request->razorpay_description;
            $razorPay->api_key = $request->razorpay_api_key;
            $razorPay->api_secret = $request->razorpay_api_secret;
            $razorPay->webhook_secret = $request->razorpay_webhook_secret;
            $razorPay->enable = $request->razorpay_enable;
            $razorPay->save();
            $notification = ['message' => "razorPay configuration update success", "type" => "success"];
            return redirect()->back()->with($notification);

        } elseif ($getaway === "nicepe") {
            $request->validate([
                // 'nicepe_name' => 'required|string|max:255',
                'nicepe_description' => 'nullable|string',
                'nicepe_logo' => 'nullable|image|max:2048',
                'nicepe_upi_id' => 'required|string|max:100',
                'nicepe_token' => 'required|string|max:100',
                'nicepe_secret_key' => 'required|string|max:100',
                'nicepe_enable' => 'required|boolean',
            ]);
            $nicePe = NicePeConfiguration::first();
            if ($request->hasFile('nicepe_logo')) {
                ImageUploadHelper::deleteFile($nicePe->logo);
                $nicePe->logo = ImageUploadHelper::uploadImage(
                    $request->file('nicepe_logo'),
                    'static'
                );
            }
            // $nicePe->name = $request->nicepe_name;
            $nicePe->name = 'nicepe';
            $nicePe->description = $request->nicepe_description;
            $nicePe->upi_id = $request->nicepe_upi_id;
            $nicePe->token = $request->nicepe_token;
            $nicePe->secret_key = $request->nicepe_secret_key;
            $nicePe->enable = $request->nicepe_enable;
            $nicePe->save();

            $notification = ['message' => "nicePe configuration update success", "type" => "success"];
            return redirect()->back()->with($notification);
        } else {
            abort(404);
        }
    }

}
