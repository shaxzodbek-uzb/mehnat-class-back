<?php

namespace Mehnat\User\Entities;

use App\Domains\Core\Traits\StatusTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Mehnat\User\Interfaces\StatusInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements StatusInterface
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
        'username',  'password', 'fullname', 'active', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', $this->STATUS_ACTIVE);
    }
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', $this->STATUS_DISABLED);
    }
    public function activate(Builder $query): boolean
    {
        return $query->update(['status' => $this->STATUS_ACTIVE]);
    }

    // public function adult(Builder $query):Builder
    // {
    //     return $query->where('age', '>=', 18);
    // }

}
