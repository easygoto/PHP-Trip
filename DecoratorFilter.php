<?php

class RequestHelper {
}

abstract class ProcessRequest {
    abstract function process(RequestHelper $req);
}

class MainProcess extends ProcessRequest {
    function process(RequestHelper $req) {
        print __CLASS__ . ": doing something useful with request\n";
    }
}

abstract class DecoratorProcess extends ProcessRequest {
    protected $processRequest;

    public function __construct(ProcessRequest $pr) {
        $this->processRequest = $pr;
    }
}

class LogRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":logging request\n";
        $this->processRequest->process($req);
    }
}

class AuthenticateRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":authenticating request\n";
        $this->processRequest->process($req);
    }
}

class StructureRequest extends DecoratorProcess {
    function process(RequestHelper $req) {
        print __CLASS__ . ":structuring request data\n";
        $this->processRequest->process($req);
    }
}

$process = new AuthenticateRequest(
    new StructureRequest(
        new LogRequest(
            new MainProcess()
        )
    )
);
$process->process(new RequestHelper());
