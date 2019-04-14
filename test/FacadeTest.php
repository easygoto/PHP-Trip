<?php

use PHPUnit\Framework\TestCase;
use Trink\Facade\Demo\Product;
use Trink\Facade\Demo\ProductFacade;

require_once '../vendor/autoload.php';

function getProductFileLines($file) {
    return file($file);
}

function getIDFromLine($line) {
    if (preg_match("/^(\d{1,3})-/", $line, $array)) {
        return $array[1];
    }
    return '';
}

function getNameFromLine($line) {
    if (preg_match("/.*-(.*)\s\d+/", $line, $array)) {
        return str_replace('_', ' ', $array[1]);
    }
    return '';
}

function getProductObjectFromID($id, $productName) {
    return new Product($id, $productName);
}

class FacadeTest extends TestCase {

    public function testDemo() {
        $facade = new ProductFacade('facade.txt');
        $facade->getProduct(234);
        $this->assertTrue(true);
    }
}
