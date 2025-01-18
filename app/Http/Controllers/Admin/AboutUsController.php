<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public function edit()
    {
        $aboutUs = AboutUs::first();
        return view('admin.about-us.form', [
            'aboutUs' => $aboutUs,
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'achievements_one_title' => 'required|string|max:255',
            'achievements_one_description' => 'required|string',
            'achievements_one_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'achievements_one_count' => 'required|integer|min:0',
            'achievements_two_title' => 'required|string|max:255',
            'achievements_two_description' => 'required|string',
            'achievements_two_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'achievements_two_count' => 'required|integer|min:0',
            'achievements_three_title' => 'required|string|max:255',
            'achievements_three_description' => 'required|string',
            'achievements_three_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'achievements_three_count' => 'required|integer|min:0',
        ]);

        try {
            $aboutUs = AboutUs::first();

            $data = [
                'title' => $request->title ?? $aboutUs->title,
                'description' => $request->description ?? $aboutUs->description,

                'achievements_one_title' => $request->achievements_one_title ?? $aboutUs->achievements_one_title,
                'achievements_one_description' => $request->achievements_one_description ?? $aboutUs->achievements_one_description,
                'achievements_one_count' => $request->achievements_one_count ?? $aboutUs->achievements_one_count,

                'achievements_two_title' => $request->achievements_two_title ?? $aboutUs->achievements_two_title,
                'achievements_two_description' => $request->achievements_two_description ?? $aboutUs->achievements_two_description,
                'achievements_two_count' => $request->achievements_two_count ?? $aboutUs->achievements_two_count,

                'achievements_three_title' => $request->achievements_three_title ?? $aboutUs->achievements_three_title,
                'achievements_three_description' => $request->achievements_three_description ?? $aboutUs->achievements_three_description,
                'achievements_three_count' => $request->achievements_three_count ?? $aboutUs->achievements_three_count,
            ];

            if ($request->has('image')) {
                ImageUploadHelper::deleteFile($aboutUs->getRawOriginal('image'));
                $data['image'] = ImageUploadHelper::uploadImage(
                    $request->file('image'),
                    'upload/about-us',
                    656,
                    545
                );
            }

            if ($request->has('achievements_one_icon')) {
                ImageUploadHelper::deleteFile($aboutUs->getRawOriginal('achievements_one_icon'));
                $data['achievements_one_icon'] = ImageUploadHelper::uploadImage(
                    $request->file('achievements_one_icon'),
                    'upload/about-us',
                    45,
                    45
                );
            }

            if ($request->has('achievements_two_icon')) {
                ImageUploadHelper::deleteFile($aboutUs->getRawOriginal('achievements_two_icon'));
                $data['achievements_two_icon'] = ImageUploadHelper::uploadImage(
                    $request->file('achievements_two_icon'),
                    'upload/about-us',
                    45,
                    45
                );
            }

            if ($request->has('achievements_three_icon')) {
                ImageUploadHelper::deleteFile($aboutUs->getRawOriginal('achievements_three_icon'));
                $data['achievements_three_icon'] = ImageUploadHelper::uploadImage(
                    $request->file('achievements_three_icon'),
                    'upload/about-us',
                    45,
                    45
                );
            }

            $aboutUs->update($data);

            return back()->with(['message' => 'update success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to update', 'type' => 'error']);
        }
    }


}
