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

    public function create($data)
    {
        $username = strtolower($data['fullname']) . '_' . mt_rand(1, 100);
        $model = $this->users;
        $model->fullname = $data['fullname'];
        $model->password = $data['password'];
        $model->username = $username;
        $model->birth_date = $data['birth_date'];
        $model->phone = $data['phone'];
        $model->gender = $data['gender'];
        
        $model->save();
        return $model;


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

    public function destroy($id)
    {
        $model = $this->getById($this->users, $id);
//        return $model;
        return $model->delete();
    }

    public function getQuery(): Builder
    {
        return $this->users->query();
    }
}
