<?php


namespace Trink\Dp\Decorator\Demo;

class PolluteDecorator extends TileDecorator
{
    public function getWealthFactor()
    {
        return $this->tile->getWealthFactor() - 4;
    }
}
