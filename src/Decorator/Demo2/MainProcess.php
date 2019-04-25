<?php


namespace Trink\Dp\Decorator\Demo2;

class MainProcess extends ProcessRequest
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": doing something useful with request\n";
    }
}
