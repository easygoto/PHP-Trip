<?php

use Composite\Demo\Archer;
use Composite\Demo\Army;
use Composite\Demo\LaserCannonUnit;
use Composite\Demo\UnitException;

require_once '../vendor/autoload.php';

try {
    $mainArmy = new Army();
    $mainArmy->addUnit(new Archer());
    $mainArmy->addUnit(new LaserCannonUnit());
    $mainArmy->addUnit(new LaserCannonUnit());
    print $mainArmy->bombardStrength();
    print "\n";

    $subArmy = new Army();
    $subArmy->addUnit(new Archer());
    $subArmy->addUnit(new Archer());
    $subArmy->addUnit(new Archer());
    $mainArmy->addUnit($subArmy);
    print $mainArmy->bombardStrength();
    print "\n";
} catch (UnitException $exception) {
    $exception->getMessage();
}