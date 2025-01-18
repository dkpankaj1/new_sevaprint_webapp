<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\HomePage;
use App\Models\Messages;
use App\Models\OurService;
use App\Models\TextSlider;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebsiteController extends Controller
{
    public function index()
    {
        $homePage = HomePage::firstOrCreate([]);
        $aboutUs = AboutUs::first();
        $sliders = TextSlider::where('is_active', 1)->latest()->get();
        $services = OurService::where('is_active', 1)->latest()->get();
        $videos = Videos::where('is_active', 1)->latest()->take(4)->get();

        return view('welcome', [
            'homepage' => $homePage,
            'aboutUs' => $aboutUs,
            'sliders' => $sliders,
            'services' => $services,
            'videos' => $videos
        ]);
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "phone" => ["required", "string"],
            "message" => ["required", "string", "max:1000"],
        ]);

        try {
            Messages::create([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "message" => $request->message,
            ]);
            return back()->with(['message' => 'Message Send success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to Send Message', 'type' => 'error']);
        }
    }
}
