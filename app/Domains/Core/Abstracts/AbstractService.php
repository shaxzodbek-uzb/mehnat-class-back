<?php

namespace Mehnat\Core\Abstracts;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractService
{

    protected $repo;
    protected $filter_fields;

    public function loadFilterParams(array $params)
    {
        return 'ok';
    }

    public function filter(Builder $query, $filter_fields, $request): Builder
    {
        foreach ($filter_fields as $key => $item) {
            if ($request->$key) {
                if ($item['type'] == 'string')
                    $query->where($key, 'like', '%' . $request->$key . '%');
                if ($item['type'] == 'number')
                    $query->where($key, $request->$key);
            }
        }
        return $query;
    }

    public function sort($query): Builder
    {
        $key = request()->get('sort_key', 'id');
        $order = request()->get('sort_order', 'desc');
        $query->orderBy($key, $order);

        return $query;
    }

    public function get($request): object
    {
        $query = $this->repo->getQuery();
        $query = $this->filter($query, $this->filter_fields, $request);
        $query = $this->sort($query);
        $query = $this->repo->getAll($query);
        return $query;
    }

    public function show($id): object
    {
        return $this->repo->getById($id);
    }

    public function delete(int $id)
    {
        return $this->repo->destroy($id);
    }

    public function create($data): object
    {
        return $this->repo->store($data);
    }

    public function edit(array $params, int $id): object
    {
        return $this->repo->update($params, $id);
    }
    public function fields()
    {
        return (new $this->resource)->fields();
    }
}
