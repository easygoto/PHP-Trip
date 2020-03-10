<?php

namespace Trink\App\Dp\Decorator\Demo2;

class StructureRequest extends DecoratorProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ":structuring request data\n";
        $this->processRequest->process($req);
    }
}
