<?php

namespace Mehnat\User\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mehnat\User\Entities\User;


class UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users = new User;
    }

    public function getAll(Builder $query = null): Collection
    {
        if ($query)
            return $query->get();
        else
            return $this->users->all();
    }

    public function create($input)
    {
        $model = $this->users;
        try {

            $model->username = $input['username'];
            $model->fullname = $input['fullname'];
            $model->age = $input['age'];
            $model->password = $input['password'];

            $model->save();

            return $model;
        } catch (\Exception $e) {
            return null;
        }

    }

    public function getById($query, $id): User
    {
        return $query->findOrFail($id);
    }

    public function update($data, $id): User
    {
        $model = $this->getById($this->users, $id);
        $model->update($data);
        return $model;
    }

    public function destroy($model, $input)
    {
        return $model->delete();
    }

    public function getQuery(): Builder
    {
        return $this->users->query();
    }
}
