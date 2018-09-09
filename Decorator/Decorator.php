<?php

abstract class Tile {
    abstract function getWealthFactor();
}

abstract class TileDecorator extends Tile {
    protected $tile;
    function __construct(Tile $tile) {
        $this->tile = $tile;
    }
}

class Plains extends Tile {
    private $wealthFactor = 2;

    function getWealthFactor() {
        return $this->wealthFactor;
    }
}

class DiamondDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor() + 2;
    }
}

class PolluteDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor() - 4;
    }
}

$tile = new Plains();
print $tile->getWealthFactor();
print "\n";

$tile = new DiamondDecorator(new Plains());
print $tile->getWealthFactor();
print "\n";

$tile = new PolluteDecorator(new DiamondDecorator(new Plains()));
print $tile->getWealthFactor();
print "\n";