<?php


namespace Trink\Dp\Decorator\Demo2;


class LogRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":logging request\n";
        $this->processRequest->process($req);
    }
}
