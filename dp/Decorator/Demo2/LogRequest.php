<?php

namespace Trink\App\Dp\Decorator\Demo2;

class LogRequest extends DecoratorProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ":logging request\n";
        $this->processRequest->process($req);
    }
}
