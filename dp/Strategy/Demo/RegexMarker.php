<?php


namespace Trink\App\Dp\Strategy\Demo;

class RegexMarker extends Marker
{
    public function mark($response)
    {
        return (preg_match($this->test, $response));
    }
}
