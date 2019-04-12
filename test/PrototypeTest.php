<?php

use Trink\Prototype\Demo\EarthForest;
use Trink\Prototype\Demo\EarthPlains;
use Trink\Prototype\Demo\EarthSea;
use Trink\Prototype\Demo\TerrainFactory;

require_once '../vendor/autoload.php';

$factory = new TerrainFactory(
    new EarthSea(),
    new EarthForest(),
    new EarthPlains()
);
var_dump($factory->getSea());
var_dump($factory->getPlains());
var_dump($factory->getForest());
