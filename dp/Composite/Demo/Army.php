<?php


namespace Trink\App\Dp\Composite\Demo;

class Army extends CompositeUnit
{
    public function bombardStrength()
    {
        $ret = 0;
        foreach ($this->units() as $unit) {
            /** @var Unit $unit */
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}
