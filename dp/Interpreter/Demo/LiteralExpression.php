<?php

namespace Trink\App\Dp\Interpreter\Demo;

class LiteralExpression extends Expression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function interpret(InterpreterContext $context)
    {
        $context->replace($this, $this->value);
    }
}
