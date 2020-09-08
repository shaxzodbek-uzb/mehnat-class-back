<?php
namespace Mehnat\Core\Traits;

trait StatusTrait
{
    static $status_active = 'active';
    static $status_disabled = 'disabled';
    
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::status_active);
    }
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', self::status_disabled);
    }
    public function activate(Builder $query): boolean
    {
        return $query->update(['status' => self::status_active]);
    }
}

