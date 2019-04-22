<?php


namespace Trink\Dp\Decorator\Demo2;


class StructureRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":structuring request data\n";
        $this->processRequest->process($req);
    }
}
