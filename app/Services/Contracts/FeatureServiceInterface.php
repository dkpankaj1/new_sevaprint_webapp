<?php

namespace App\Services\Contracts;

use App\Models\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

interface FeatureServiceInterface
{
    public function getDataTableData():JsonResponse;
    public function findFeature($id) : ?Feature;
    public function updateFeature(int $id,array $data)  : Feature;
    public function updateFeatureIcon(int $id,UploadedFile $file)  : Feature;
}