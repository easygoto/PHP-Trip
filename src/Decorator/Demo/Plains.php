<?php


namespace Trink\Dp\Decorator\Demo;


class Plains extends Tile {
    private $wealthFactor = 2;

    function getWealthFactor() {
        return $this->wealthFactor;
    }
}
