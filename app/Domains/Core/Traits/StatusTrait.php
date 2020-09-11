<?php
trait StatusTrait
{
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