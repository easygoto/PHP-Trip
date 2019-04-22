<?php


namespace Trink\Dp\Decorator\Demo;


class DiamondDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor() + 2;
    }
}
