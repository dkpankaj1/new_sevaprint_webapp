<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadHelper
{
    public static function uploadImage(UploadedFile $file, string $directory = 'uploads', int $width = 100, int $height = 100, ?string $customFileName = null)
    {
        try {
            $manager = new ImageManager(new Driver());

            // Generate file name
            $fileName = $customFileName
                ? $customFileName . '.' . $file->getClientOriginalExtension()
                : Str::uuid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path($directory);

            // Create directory if not exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $fullPath = $destinationPath . '/' . $fileName;

            // Read and resize the image while preserving transparency
            $image = $manager->read($file)
                ->resize($width, $height);

            // Save the image with transparency support for PNG
            if ($file->getClientOriginalExtension() === 'png') {
                $image->toPng()->save($fullPath);
            } else {
                $image->toJpeg(80)->save($fullPath);
            }

            return $directory . '/' . $fileName;

        } catch (\Exception $e) {
            \Log::error("Image upload failed: " . $e->getMessage());
            return null;
        }
    }


    public static function deleteFile(?string $filePath): bool
    {
        if ($filePath != null) {
            $fullPath = public_path($filePath);
            if (File::exists($fullPath)) {
                return File::delete($fullPath);
            }
        }
        return false;
    }

}
