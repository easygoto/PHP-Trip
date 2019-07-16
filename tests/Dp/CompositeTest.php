<?php

namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Composite\Demo\Archer;
use Trink\Dp\Composite\Demo\Army;
use Trink\Dp\Composite\Demo\LaserCannonUnit;
use Trink\Dp\Composite\Demo\UnitException;

class CompositeTest extends TestCase
{
    public function test()
    {
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
