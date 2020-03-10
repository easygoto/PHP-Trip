<?php

namespace Trink\App\Dp\Decorator\Demo;

class DiamondDecorator extends TileDecorator
{
    public function getWealthFactor()
    {
        return $this->tile->getWealthFactor() + 2;
    }
}
