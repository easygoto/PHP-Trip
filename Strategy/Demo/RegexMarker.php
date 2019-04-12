<?php


namespace Trink\Strategy\Demo;


class RegexMarker extends Marker {
    function mark($response) {
        return (preg_match($this->test, $response));
    }
}