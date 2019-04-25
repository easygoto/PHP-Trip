<?php


namespace Trink\Dp\Composite\Demo;

abstract class CompositeUnit extends Unit
{
    private $units = [];

    public function getComposite()
    {
        return $this;
    }

    protected function units()
    {
        return $this->units;
    }

    public function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, 1)) {
            return;
        }
        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, [$unit], function ($a, $b) {
            return $a !== $b;
        });
    }
}
