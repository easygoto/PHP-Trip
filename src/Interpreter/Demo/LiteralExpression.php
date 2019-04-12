<?php


namespace Trink\Interpreter\Demo;


class LiteralExpression extends Expression {
    private $value;

    function __construct($value) {
        $this->value = $value;
    }

    function interpret(InterpreterContext $context) {
        $context->replace($this, $this->value);
    }
}
