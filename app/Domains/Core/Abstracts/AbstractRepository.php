<?php


namespace App\Domains\Core\Abstracts;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractRepository
{
    protected $model;

    public function getQuery()
    {
        return $query = $this->model->query();
    }

    public function getById($query, $id): object
    {
        return $query->findOrFail($id);
    }

    public function getAll(Builder $query = null): object
    {
        if (request()->get('getAll', false))
            return $query->get();
        else
            return $query->paginate(request()->get('limit', 15));
    }

    public function store($data, $params): array
    {
        $columns = [];
        foreach ($data as $key => $item) {
            if (in_array($key, $params)) {
                array_push($columns, [$key => $item]);
            }
        }
    }
}
