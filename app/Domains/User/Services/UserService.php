<?php

namespace Mehnat\User\Services;

use Mehnat\Core\Abstracts\AbstractService;
use Mehnat\User\Repositories\UserRepository;
use Mehnat\User\Resources\UserResource;

class UserService extends AbstractService
{
    protected $resource = UserResource::class;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->filter_fields = ['fullname' => 'string'];
    }
}
