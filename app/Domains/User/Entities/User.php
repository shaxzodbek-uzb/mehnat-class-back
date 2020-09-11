<?php

namespace Mehnat\User\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements StatusInterface
{

    use StatusTrait;
    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('adult', function (Builder $builder) {
            $builder->where('age', '>', 17);
        });
        
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adult(Builder $query):Builder
    {
        return $query->where('age', '>=', 18);
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

}
