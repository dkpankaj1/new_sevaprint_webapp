<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebsiteSettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $homepage = HomePage::firstOrCreate([]);
        return view('admin.website.index', ['homepage' => $homepage]);
    }

    public function updateHomepage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $homepage = HomePage::first();
            if ($request->has('image')) {
                ImageUploadHelper::deleteFile($homepage->getRawOriginal('image'));
                $homepage->image = ImageUploadHelper::uploadImage(
                    $request->file('image'),
                    'upload/homepage',
                    819,
                    674
                );
            }
            $homepage->save();
            return back()->with(['message' => 'update success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to update', 'type' => 'error']);
        }
    }
}
