<?php
namespace App\Services;

use App\Models\Feature;
use App\Repositories\Contracts\FeatureRepositoryInterface;
use App\Services\Contracts\FeatureServiceInterface;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class FeatureService implements FeatureServiceInterface
{
    protected $featureRepository;

    public function __construct(FeatureRepositoryInterface $featureRepository)
    {
        $this->featureRepository = $featureRepository;
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

            ->addColumn('updated_at', function ($feature) {
                return $feature->updated_at ? $feature->updated_at->diffForHumans() : 'N/A';
            })

            ->addColumn('thumbnail', function ($feature) {
                $thumbnailUrl = $feature->getFirstMediaUrl('feature', 'thumbnail') ?: asset('assets/images/service.png');
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
            "enable" => $data['enable'],
        ]);
    }
}