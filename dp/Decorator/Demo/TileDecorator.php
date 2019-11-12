<?php


namespace Trink\App\Dp\Decorator\Demo;

abstract class TileDecorator extends Tile
{
    protected $tile;
    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}
