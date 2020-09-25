<?php

namespace Mehnat\User\Entities;

use Mehnat\Core\Traits\StatusTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mehnat\Core\Interfaces\ResponsibleInterface;

class User extends Authenticatable implements ResponsibleInterface
{
    use Notifiable;
    use StatusTrait;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('adult', function (Builder $builder) {
            $builder->where('age', '>', 17);
        });

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',  'password', 'fullname', 'status', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function transformer():array
    {
        return [
            'username' => $this->username,
            'fullname' => $this->fullname,
            'age' => $this->age,
            'status' => $this->status,
            'articles' => $this->articles->load('comments'),
            'comments' => $this->comments
        ];
    }

    // public function getRelations($item = null, $relations = null)
    // {
    //     if(is_array($relations)) {
    //         foreach ($relations as $key => $relation) {
    //            $this->getRelations($item, $relation);
    //         }
    //     } else {
    //         if(strpos($relations, '.')) {
    //             $withs = explode('.', $relations);
    //             $count_relations = count($withs);

    //             foreach (explode('.', $relations) as $segment) {
    //                 try {
    //                     $item = $item->$segment;
    //                 } catch (\Exception $e) {
    //                     return value(null);
    //                 }
    //             }

    //             // for ($i=0; $i <= $count_relations; $i++) {
    //             //     $model = $withs[$i];

    //             //     if($item->$model()->exists()) {
    //             //         $item->with($model);
    //             //     }

    //             //     if($i > 0) {

    //             //     }
    //             // }
    //         }
    //     }


    //     return $item;
    // }

}
