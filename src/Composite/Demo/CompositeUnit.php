<?php


namespace Trink\Composite\Demo;


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
