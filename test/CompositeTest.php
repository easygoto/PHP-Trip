<?php

use PHPUnit\Framework\TestCase;
use Trink\Composite\Demo\Archer;
use Trink\Composite\Demo\Army;
use Trink\Composite\Demo\LaserCannonUnit;
use Trink\Composite\Demo\UnitException;

require_once '../vendor/autoload.php';

class CompositeTest extends TestCase {

    public function testDemo() {
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
        $this->assertTrue(true);
    }
}
