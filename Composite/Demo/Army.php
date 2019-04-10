<?php


namespace Composite\Demo;


class Army extends CompositeUnit {
    function bombardStrength() {
        $ret = 0;
        foreach ($this->units() as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}
