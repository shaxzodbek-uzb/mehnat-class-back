<?php

namespace Mehnat\User\Services;

use App\Http\Requests\UserRequest;
use Mehnat\Core\Abstracts\AbstractService;
use Mehnat\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Collection;
use Mehnat\User\Entities\User;
use Mehnat\User\Resources\UserResource;

class UserService extends AbstractService
{
    private $userRepo;
    protected $resource = UserResource::class;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function sort($query): Builder
    {
        $key = request()->get('sort_key', 'username');
        $order = request()->get('sort_order', 'asc');
        $query->orderBy($key, $order);

        return $query;
    }

    public function getUsers(): Collection
    {
        $users = $this->userRepo->getQuery();
        $users = $this->sort($users);
        $users = $users->orderBy('id', 'desc');
        $users = $this->userRepo->getAll($users->with(request('include')));
        return $users;
    }

    public function getShow($id): User
    {
        $user = $this->userRepo->getQuery();
        $user = $user->with(request('include'));
        $user = $this->userRepo->getById($user, $id);
        return $user;
    }

    public function getCreate(UserRequest $request): User
    {
        $data = $request->validated();
        $user = $this->userRepo->create($data);
        return $user;
    }

    public function getUpdate(UpdateUserRequest $request,int $id):User
    {
        $data = $request->validated();
        $user = $this->userRepo->update($data, $id);
        return $user;
    }

    public function getDelete(int $id)
    {
        $user = $this->userRepo->destroy($id);
        return $user;
    }
}
