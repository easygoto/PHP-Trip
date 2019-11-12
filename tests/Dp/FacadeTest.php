<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\Facade\Demo\ProductFacade;

class FacadeTest extends TestCase
{
    public function test()
    {
        $facade = new ProductFacade('facade.txt');
        var_dump($facade->getProduct(234));
        $this->assertTrue(true);
    }
}
