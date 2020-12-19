<?php

namespace Mehnat\Core\Fields;

class BelongsTo {
    public $key;
    public $value;
    public $label;
    public $type = 'belongsToField';
    public $relation_name;

    public static function make(string $class, $relation_name): self
    {
        $related_resource = new $class;
        $obj = new self;
        $obj->key = $relation_name . '_id';
        $obj->relation_name = $relation_name;
        $obj->related_object_title = $related_resource->title;
        $obj->label = $relation_name;
        $obj->value = '';
        return $obj;
    }
}
