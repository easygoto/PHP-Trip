<?php

use Prototype\Demo\EarthForest;
use Prototype\Demo\EarthPlains;
use Prototype\Demo\EarthSea;
use Prototype\Demo\TerrainFactory;

require_once '../vendor/autoload.php';

$factory = new TerrainFactory(
    new EarthSea(),
    new EarthForest(),
    new EarthPlains()
);
var_dump($factory->getSea());
var_dump($factory->getPlains());
var_dump($factory->getForest());
