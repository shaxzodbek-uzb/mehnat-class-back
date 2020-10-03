<?php

namespace Mehnat\User\Entities;

use Shanmuga\LaravelEntrust\Models\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [ 'name', 'display_name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
