<?php

namespace App\Repositories\Eloquent;

use App\Models\Feature;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\FeatureRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class FeatureRepository extends BaseRepository implements FeatureRepositoryInterface
{
    public function __construct(Feature $feature)
    {
        parent::__construct($feature);
    }
    public function query():Builder
    {
        return parent::query();
    }
    public function find($id): ?Feature
    {
        return parent::find($id);
    }
    public function update($id, array $data): Feature
    {
        return parent::update($id, $data);
    }

}