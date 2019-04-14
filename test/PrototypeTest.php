<?php

use PHPUnit\Framework\TestCase;
use Trink\Prototype\Demo\EarthForest;
use Trink\Prototype\Demo\EarthPlains;
use Trink\Prototype\Demo\EarthSea;
use Trink\Prototype\Demo\TerrainFactory;

require_once '../vendor/autoload.php';

class PrototypeTest extends TestCase {

    public function testDemo() {
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
