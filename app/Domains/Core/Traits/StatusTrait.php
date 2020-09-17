<?php
namespace App\Domains\Core\Traits;

trait StatusTrait
{

    public $status_active = '1';
    public $status_disabled = '2';
    public $status_bunned = '0';
    

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

