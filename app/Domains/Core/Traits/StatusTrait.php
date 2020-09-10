<?php
namespace Mehnat\Core\Traits;

trait StatusTrait
{
    static $status_active = '1';
    static $status_disabled = '2';
    static $status_bunned = '0';
    
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

