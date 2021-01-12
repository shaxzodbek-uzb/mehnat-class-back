<?php


namespace Mehnat\Core\Fields;


class Select
{
    public $key;
    public $value;
    public $label;
    public $type = 'selectField';

    public static function make(string $key): self
    {
        $obj = new self;
        $obj->key = $key;
        $obj->label = $key;
        $obj->value = '';
        return $obj;
    }
}
