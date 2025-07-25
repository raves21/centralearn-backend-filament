<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById(string $id, array $relationships = [])
    {
        return $this->model->with($relationships)->findOrFail($id);
    }

    public function ensureExists(string $id)
    {
        $this->model->findOrFail($id);
    }

    public function updateById(string $id, array $formData)
    {
        $record = $this->model->findOrFail($id);
        $record->update($formData);
        return $record->fresh();
    }

    public function create(array $formData)
    {
        $modelClass = get_class($this->model);
        $record = $modelClass::create($formData);
        return $record;
    }

    public function deleteById(string $id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return true;
    }

    public function deleteManyById(array $ids)
    {
        $modelClass = get_class($this->model);
        $modelClass::destroy($ids);
        return true;
    }

    public function getAll(
        array $relationships = [],
        array $filters = [],
        string $orderBy = 'created_at',
        string $sortDirection = 'desc',
        bool $paginate = true
    ) {
        $query = $this->model->with($relationships)
            ->when(!empty($filters), function ($query) use ($filters) {
                foreach ($filters as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->orderBy($orderBy, $sortDirection);

        if ($paginate) return $query->paginate();
        return $query->get();
    }
}
