<?php

namespace App\Services;

use App\Helpers\ImageUploadHelper;
use App\Models\Feature;
use App\Models\GeneralSetting;
use App\Repositories\Contracts\FeatureRepositoryInterface;
use App\Services\Contracts\FeatureServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Yajra\DataTables\Facades\DataTables;

class FeatureService implements FeatureServiceInterface
{
    protected $featureRepository;
    protected $generalSetting;

    public function __construct(FeatureRepositoryInterface $featureRepository)
    {
        $this->featureRepository = $featureRepository;
        $this->generalSetting = GeneralSetting::first();
    }
    public function getDataTableData(): JsonResponse
    {
        return DataTables::eloquent($this->featureRepository->query())
            ->addIndexColumn()

            ->addColumn('status', function ($feature) {
                return view('components.badges', [
                    'type' => $feature->enable ? 'success' : 'danger',
                    'text' => $feature->enable ? 'active' : 'in-active',
                ]);
            })

            ->addColumn('fee', function ($feature) {
                return "{$this->generalSetting->currency->symbol} {$feature->fee}";
            })

            ->addColumn('commission', function ($feature) {
                return $feature->commission_type == 0 
                ? "{$this->generalSetting->currency->symbol} {$feature->commission}" 
                : "{$feature->commission} (%)";
            })

            ->addColumn('commission_type', function ($feature) {
                return $feature->commission_type == 0 ? "Fixed" : 'Percent';
            })

            ->addColumn('updated_at', function ($feature) {
                return $feature->updated_at ? $feature->updated_at->diffForHumans() : 'N/A';
            })

            ->addColumn('thumbnail', function ($feature) {
                $thumbnailUrl = $feature->icon;
                return view('components.user-avatar', ['src' => $thumbnailUrl]);
            })

            ->addColumn('action', function ($feature) {
                return view('components.show-btn', [
                    'url' => route('admin.feature.show', $feature->id),
                ]) .
                    view('components.edit-btn', [
                        'url' => route('admin.feature.edit', $feature->id),
                    ]);
            })

            ->make(true);
    }

    public function findFeature($id): ?Feature
    {
        return $this->featureRepository->find($id);
    }

    public function updateFeature(int $id, array $data): Feature
    {
        return $this->featureRepository->update($id, [
            "name" => $data['name'],
            "description" => $data['description'],
            "fee" => $data['fee'],
            "commission" => $data['commission'],
            "commission_type" =>$data['commission_type'],
            "enable" => $data['enable'],
        ]);
    }

    public function updateFeatureIcon(int $id, UploadedFile $path) :Feature
    {
        $feature =$this->featureRepository->find($id);
        ImageUploadHelper::deleteFile($feature->getRawOriginal('icon'));
        $path= ImageUploadHelper::uploadImage($path,'upload/feature',200,113);
        return $this->featureRepository->update($id, [
            "icon" => $path
        ]);
    }
}
