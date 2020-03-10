<?php

namespace Trink\App\Dp\Interpreter\Demo;

class InterpreterContext
{
    private $expressionStore = [];

    public function replace(Expression $exp, $value)
    {
        $this->expressionStore[$exp->getKey()] = $value;
    }

    public function lookup(Expression $exp)
    {
        return $this->expressionStore[$exp->getKey()];
    }
}
