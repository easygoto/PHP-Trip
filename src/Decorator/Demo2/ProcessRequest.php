<?php


namespace Trink\Dp\Decorator\Demo2;

abstract class ProcessRequest
{
    abstract public function process(RequestHelper $req);
}
