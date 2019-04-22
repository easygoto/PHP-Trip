<?php


namespace Trink\Dp\Decorator\Demo2;


class AuthenticateRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":authenticating request\n";
        $this->processRequest->process($req);
    }
}
