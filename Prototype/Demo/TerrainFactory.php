<?php


namespace Prototype\Demo;


class TerrainFactory {
    private $sea;
    private $forest;
    private $plains;

    function __construct(Sea $sea, Forest $forest, Plains $plains) {
        $this->sea    = $sea;
        $this->forest = $forest;
        $this->plains = $plains;
    }

    function getSea() {
        return clone $this->sea;
    }

    function getPlains() {
        return clone $this->plains;
    }

    function getForest() {
        return clone $this->forest;
    }
}
