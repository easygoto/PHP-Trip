<?php


namespace Trink\Dp\Decorator\Demo;

class Plains extends Tile
{
    private $wealthFactor = 2;

    public function getWealthFactor()
    {
        return $this->wealthFactor;
    }
}
