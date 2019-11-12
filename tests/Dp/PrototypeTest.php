<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\Prototype\Demo\EarthForest;
use Trink\App\Dp\Prototype\Demo\EarthPlains;
use Trink\App\Dp\Prototype\Demo\EarthSea;
use Trink\App\Dp\Prototype\Demo\TerrainFactory;

class PrototypeTest extends TestCase
{
    public function test()
    {
        $factory = new TerrainFactory(
            new EarthSea(),
            new EarthForest(),
            new EarthPlains()
        );
        var_dump($factory->getSea());
        var_dump($factory->getPlains());
        var_dump($factory->getForest());
        $this->assertTrue(true);
    }
}
