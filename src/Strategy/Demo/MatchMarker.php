<?php


namespace Trink\Dp\Strategy\Demo;

class MatchMarker extends Marker
{
    public function mark($response)
    {
        return ($this->test == $response);
    }
}
