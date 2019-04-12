<?php


namespace Trink\Strategy\Demo;


class MatchMarker extends Marker {
    function mark($response) {
        return ($this->test == $response);
    }
}