<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class BaseRepository
{
    /**
     * @var TModel
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param TModel $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new query builder instance.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * Get all models.
     *
     * @return Collection<int, TModel>
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a model by ID.
     *
     * @param int $id
     * @return TModel|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return TModel
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a model instance by ID.
     *
     * @param int $id
     * @param array $data
     * @return TModel
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        throw new \Exception("Model not found");
    }

    /**
     * Delete a model instance by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if ($model) {
            $model->delete();
            return true;
        }
        return false;
    }
}
