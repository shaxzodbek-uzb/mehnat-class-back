<?php

namespace App\Mehnat\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('state', $this->STATUS_CONFIRMED);
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
