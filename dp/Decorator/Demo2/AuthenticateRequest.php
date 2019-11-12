<?php


namespace Trink\App\Dp\Decorator\Demo2;

class AuthenticateRequest extends DecoratorProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ":authenticating request\n";
        $this->processRequest->process($req);
    }
}
