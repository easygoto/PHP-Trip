<?php


namespace Trink\Dp\Interpreter\Demo;


// 与表达式
class BooleanAndExpression extends OperatorExpression {
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l && $result_r);
    }
}
