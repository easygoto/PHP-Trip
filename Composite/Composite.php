<?php

class UnitException extends Exception {
}

abstract class Unit {
    function getComposite(){
        return null;
    }

    abstract function bombardStrength();
}

abstract class CompositeUnit extends Unit {
    private $units = [];

    function getComposite(){
        return $this;
    }

    protected function units(){
        return $this->units;
    }

    function addUnit(Unit $unit) {
        if (in_array($unit, $this->units, 1)) {
            return;
        }
        $this->units[] = $unit;
    }

    function removeUnit(Unit $unit) {
        $this->units = array_udiff($this->units, [$unit], function ($a, $b) {
            return $a !== $b;
        });
    }
}

class Archer extends Unit {
    function bombardStrength() {
        return 4;
    }
}

class LaserCannonUnit extends Unit {
    function bombardStrength() {
        return 44;
    }
}

class Army extends CompositeUnit {
    function bombardStrength() {
        $ret = 0;
        foreach ($this->units() as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

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