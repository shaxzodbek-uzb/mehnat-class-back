<?php

namespace Mehnat\User\Repositories;

use App\Domains\Core\Abstracts\AbstractRepository;
use Mehnat\User\Entities\User;


class UserRepository extends AbstractRepository
{
    public function __construct(User $entity)
    {
        $this->entity = $entity;
    }

}
