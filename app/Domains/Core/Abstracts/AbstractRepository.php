<?php


namespace App\Domains\Core\Abstracts;

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

    public function getAll(object $query = null, int $perPage = 0): object
    {
        $q = $this->entity;

        if($query)
            $q = $query;

        return $q->get();
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
