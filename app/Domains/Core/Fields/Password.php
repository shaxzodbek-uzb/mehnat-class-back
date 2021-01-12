<?php


namespace Mehnat\Core\Fields;


class Password
{
    public $key;
    public $value;
    public $label;
    public $type = 'passwordField';

    public static function make(string $key): self
    {
        $obj = new self;
        $obj->key = $key;
        $obj->label = $key;
        $obj->value = '';
        return $obj;
    }
}
