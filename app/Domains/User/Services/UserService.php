<?php

namespace Mehnat\User\Services;

use App\Http\Requests\UserRequest;
use Mehnat\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Collection;
use Mehnat\User\Entities\User;

class UserService
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function filter(Builder $query): Builder
    {
        $user_name = request()->get('username', false);
        $age = request()->get('age', false);
        $status = request()->get('status', false);

        if ($user_name) {
            $query->where('username', 'like', "%$user_name%");
        }

        if ($age) {
            $query->where('age', '=', $age);
        }

        if ($status) {
            switch ($status) {
                case 1:
                    $query->active();
                    break;
                case 2:
                    $query->disabled();
                    break;
                case 0:
                    $query->bunned();
                    break;
                default:
                    break;
            }
        }

        return $query;
    }

    public function sort($query): Builder
    {
        $key = request()->get('sort_key', 'username');
        $order = request()->get('sort_order', 'asc');
        $query->orderBy($key, $order);

        return $query;
    }

    public function notify($user, string $type)
    {
        $strategy = (new NotificationStrategy)->getStrategy($type);
        $strategy->send();
    }

    public function getUsers(): Collection
    {
        $users = $this->userRepo->getQuery();
        $users = $this->filter($users);
        $users = $this->sort($users);
        $users = $users->orderBy('id', 'desc');
        $users = $this->userRepo->getAll($users->with(request()->get('include')));
        return $users;
    }

    public function getShow($id): User
    {
        $user = $this->userRepo->getQuery();
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
