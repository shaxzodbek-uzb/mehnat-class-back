<?php
namespace Mehnat\User\Repositories;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function getAll($query):Builder
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
    	
    }
}