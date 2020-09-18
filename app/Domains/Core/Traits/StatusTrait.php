<?php
namespace Mehnat\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

trait StatusTrait
{

    static $STATUS_ACTIVE = 'active';
    static $STATUS_DISABLED = 'disabled';


    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', $this->status_active);
    }

    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', $this->status_disabled);
    }

    public function scopeBunned(Builder $query): Builder
    {
        return $query->where('status', $this->status_bunned);
    }

    public function activate(Builder $query): boolean
    {
        return $query->update(['status' => $this->status_active]);
    }
}
