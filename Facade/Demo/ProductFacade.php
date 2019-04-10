<?php


namespace Facade\Demo;


class ProductFacade {
    private $file;
    private $products = [];

    public function __construct($file) {
        $this->file = $file;
        $this->compile();
    }

    private function compile() {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line) {
            $id                  = getIDFromLine($line);
            $name                = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromID($id, $name);
        }
    }

    function getProducts() {
        return $this->products;
    }

    function getProduct($id) {
        return $this->products[$id];
    }
}
