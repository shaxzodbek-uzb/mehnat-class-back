<?php
namespace Mehnat\User\Repositories;
use Illuminate\Database\Eloquent\Builder;

use Mehnat\User\Entities\User;

class UserRepository
{
    public function getAll(Builder $query) 
    {
        return $query->get();
    }

    public function create($model, $input) 
    {
    	try {

    		$model->username = $input['username'];
    		$model->fullname = $input['fullname'];
    		$model->age = $input['age'];
    		$model->password = $input['password'];

    		$model->save();

    		return $model;
    	} catch(\Exception $e) {
    		return null;
    	}

    }

    public function getById($query, $id)
    {
    	return $query->findOrFail($id);
    }

    public function update($model, $input)
    {
    	return $model->update([
    		'username' => $input['username'],
    		'fullname' => $input['fullname'],
    		'age' => $input['age'],
    		'password' => $input['password']
    	]);
    }

    public function destroy($model, $input)
    {
    	return$model->delete();
    }
}
