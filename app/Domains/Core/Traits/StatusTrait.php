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

    // public function getRelations($item = null, $relations = null)
    // {
    //     if(is_array($relations)) {
    //         foreach ($relations as $key => $relation) {
    //            $this->getRelations($item, $relation);
    //         }
    //     } else {
    //         if(strpos($relations, '.')) {
    //             $withs = explode('.', $relations);
    //             $count_relations = count($withs);

    //             foreach (explode('.', $relations) as $segment) {
    //                 try {
    //                     $item = $item->$segment;
    //                 } catch (\Exception $e) {
    //                     return value(null);
    //                 }
    //             }

    //             for ($i=0; $i <= $count_relations; $i++) {
    //                 $model = $withs[$i];

    //                 if($item->$model()->exists()) {
    //                     $item->with($model);
    //                 }

    //                 if($i > 0) {

    //                 }
    //             }
    //         }
    //     }


    //     return $item;
    // }
}
