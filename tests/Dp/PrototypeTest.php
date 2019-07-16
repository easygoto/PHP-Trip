<?php

namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Prototype\Demo\EarthForest;
use Trink\Dp\Prototype\Demo\EarthPlains;
use Trink\Dp\Prototype\Demo\EarthSea;
use Trink\Dp\Prototype\Demo\TerrainFactory;

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
