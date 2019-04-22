<?php


namespace Trink\Dp\Interpreter\Demo;


class InterpreterContext {
    private $expressionStore = [];

    function replace(Expression $exp, $value) {
        $this->expressionStore[$exp->getKey()] = $value;
    }

    function lookup(Expression $exp) {
        return $this->expressionStore[$exp->getKey()];
    }
}
