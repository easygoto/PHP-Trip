<?php

namespace Trink\App\Dp\Facade\Demo;

function getProductFileLines($file)
{
    return file($file);
}

function getIDFromLine($line)
{
    if (preg_match("/^(\d{1,3})-/", $line, $array)) {
        return $array[1];
    }
    return '';
}

function getNameFromLine($line)
{
    if (preg_match("/.*-(.*)\s\d+/", $line, $array)) {
        return str_replace('_', ' ', $array[1]);
    }
    return '';
}

function getProductObjectFromID($id, $productName)
{
    return new Product($id, $productName);
}

class ProductFacade
{
    private $file;
    private $products = [];

    public function __construct($file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile()
    {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line) {
            $id                  = getIDFromLine($line);
            $name                = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromID($id, $name);
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProduct($id)
    {
        return $this->products[$id];
    }
}
