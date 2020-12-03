<?php


namespace App\Domains\Core\Abstracts;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractRepository
{
    protected $entity;

    public function getQuery()
    {
        return $this->entity->query();
    }

    public function getById($id): object
    {
        return $this->entity->find($id);
    }

    public function getAll(int $perPage = 0): object
    {
            return $this->entity->get();
    }

    public function store(array $params): object
    {
        return $this->entity->create($params);
    }
    
    public function update(array $params, int $id): object
    {
        $object = $this->getById($id);
        $object->update($params);
        return $object;
    }

    public function destroy(int $id): bool
    {
        $entity = $this->getById($id);
        return $entity->delete();
    }
}
