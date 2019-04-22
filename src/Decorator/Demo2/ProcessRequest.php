<?php


namespace Trink\Dp\Decorator\Demo2;


abstract class ProcessRequest {
    abstract function process(RequestHelper $req);
}
