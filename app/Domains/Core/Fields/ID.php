<?php

namespace Mehnat\Core\Fields;
 
class ID {
    public $key;
    public $value;
    public $label;
    public $type = 'idField';

    public static function make(string $key = 'id'): self
    {
        $obj = new self;
        $obj->key = $key;
        $obj->label = $key;
        $obj->value = '';
        return $obj;
    }
}