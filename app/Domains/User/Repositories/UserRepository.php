<?php
namespace Mehnat\User\Repository;
class UserRepository
{
    public function getAll($query)
    {
        return $query->get();
    }
}