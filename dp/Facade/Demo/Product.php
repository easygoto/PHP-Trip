<?php


namespace Trink\App\Dp\Facade\Demo;

class Product
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}
