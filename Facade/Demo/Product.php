<?php


namespace Trink\Facade\Demo;


class Product {
    public $id;
    public $name;

    function __construct($id, $name) {
        $this->id   = $id;
        $this->name = $name;
    }
}
