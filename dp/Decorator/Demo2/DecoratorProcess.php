<?php

namespace Trink\App\Dp\Decorator\Demo2;

abstract class DecoratorProcess extends ProcessRequest
{
    protected $processRequest;

    public function __construct(ProcessRequest $pr)
    {
        $this->processRequest = $pr;
    }
}
