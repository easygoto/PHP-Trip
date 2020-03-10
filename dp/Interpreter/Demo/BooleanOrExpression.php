<?php

namespace Trink\App\Dp\Interpreter\Demo;

// 或表达式
class BooleanOrExpression extends OperatorExpression
{
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r)
    {
        $context->replace($this, $result_l || $result_r);
    }
}
