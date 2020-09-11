<?php
interface StatusInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';
    public function scopeActive(Builder $query): Builder;
    public function scopeDisabled(Builder $query): Builder;
    public function activate(Builder $query): boolean;
}