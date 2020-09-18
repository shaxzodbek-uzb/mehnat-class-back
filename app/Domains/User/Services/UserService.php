<?php
namespace Mehnat\User\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Mehnat\User\Repositories\UserRepository;

class UserService
{
    protected $repo;

    public function __construct() 
    {
        $this->repo = new UserRepository();
    }

    public function getAll(Builder $query) :Collection
    {
        return $this->repo->getAll($query);
    }

    public function filter(Builder $query): Builder
    {
        $user_name = request()->get('username', false);
        $age = request()->get('age', false);
        $status = request()->get('status', false);

        if ($user_name){
            $query->where('username', 'like', "%$user_name%");
        }

        if ($age){
            $query->where('age', '=', $age);
        }

        if ($status){
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

    public function sort($query)
    {
        $key = request()->get('sort_key','username');
        $order = request()->get('sort_order', 'asc');
        $query->orderBy($key, $order);

        return $query;
    }
    public function notify($user, string $type)
    {
        $strategy = (new NotificationStrategy)->getStrategy($type);
        $strategy->send();
    }
}