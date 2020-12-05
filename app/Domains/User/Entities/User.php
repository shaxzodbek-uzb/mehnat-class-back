<?php

namespace Mehnat\User\Entities;

use Laravel\Passport\HasApiTokens;
use Mehnat\Core\Traits\StatusTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use StatusTrait;
    use LaravelEntrustUserTrait;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */

    protected static function boot()
    {
        parent::boot();

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',  'password', 'fullname', 'status', 'birth_date', 'gender', 'phone', 'avatar', 'background_img'
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
        return $this->hasMany(\Mehnat\Comment\Entities\Comment::class);
    }

    public function articles()
    {
        return $this->hasMany(\Mehnat\Article\Entities\Article::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
