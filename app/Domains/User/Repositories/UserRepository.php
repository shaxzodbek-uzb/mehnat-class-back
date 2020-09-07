<?php
namespace Mehnat\User\Repositories;

class UserRepository
{
    public function getAll($query)
    {
        return $query->get();
    }
}