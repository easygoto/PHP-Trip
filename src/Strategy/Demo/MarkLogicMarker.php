<?php


namespace Trink\Dp\Strategy\Demo;


class MarkLogicMarker extends Marker {
    private $engine;

    public function __construct($test) {
        parent::__construct($test);
//        $this->engine = new MarkParse($test);
    }

    function mark($response) {
//        return $this->engine->evaluate($response);
        return true;
    }
}