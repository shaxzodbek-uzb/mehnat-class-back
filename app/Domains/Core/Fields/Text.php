<?php

namespace Mehnat\Core\Fields;
 
class Text {
    public $key;
    public $value;
    public $label;
    public $type = 'textField';

    public static function make(string $key): self
    {
        $obj = new self;
        $obj->key = $key;
        $obj->label = $key;
        $obj->value = '';
        return $obj;
    }
}