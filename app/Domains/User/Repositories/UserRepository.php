<?php
namespace Mehnat\User\Repositories;

use Mehnat\User\Entities\User;

class UserRepository
{
    public function getAll($query)
    {
        return $query->get();
    }

    public function create($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return $user;
    }
}
