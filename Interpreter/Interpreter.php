<?php

abstract class Expression {
    private static $keyCount = 0;
    private $key;

    abstract function interpret(InterpreterContext $context);

    function getKey() {
        if (!isset($this->key)) {
            self::$keyCount++;
            $this->key = self::$keyCount;
        }
        return $this->key;
    }
}

class LiteralExpression extends Expression {
    private $value;

    function __construct($value) {
        $this->value = $value;
    }

    function interpret(InterpreterContext $context) {
        $context->replace($this, $this->value);
    }
}

class VariableExpression extends Expression {
    private $name;
    private $val;

    public function __construct($name, $val = null) {
        $this->name = $name;
        $this->val  = $val;
    }

    function interpret(InterpreterContext $context) {
        if (!is_null($this->val)) {
            $context->replace($this, $this->val);
            $this->val = null;
        }
    }

    function setValue($value) {
        $this->val = $value;
    }

    function getKey() {
        return $this->name;
    }
}

abstract class OperatorExpression extends Expression {
    protected $l_op;
    protected $r_op;

    public function __construct(Expression $l_op, Expression $r_op) {
        $this->l_op = $l_op;
        $this->r_op = $r_op;
    }

    function interpret(InterpreterContext $context) {
        $this->l_op->interpret($context);
        $this->r_op->interpret($context);
        $result_l = $context->lookup($this->l_op);
        $result_r = $context->lookup($this->r_op);
        $this->doInterpret($context, $result_l, $result_r);
    }

    protected abstract function doInterpret(InterpreterContext $context, $result_l, $result_r);
}

// 比较表达式
class EqualsExpression extends OperatorExpression {
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l == $result_r);
    }
}

// 或表达式
class BooleanOrExpression extends OperatorExpression {
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l || $result_r);
    }
}

// 与表达式
class BooleanAndExpression extends OperatorExpression {
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l && $result_r);
    }
}

class InterpreterContext {
    private $expressionStore = [];

    function replace(Expression $exp, $value) {
        $this->expressionStore[$exp->getKey()] = $value;
    }

    function lookup(Expression $exp) {
        return $this->expressionStore[$exp->getKey()];
    }
}

$context = new InterpreterContext();
$literal = new LiteralExpression('four');
$literal->interpret($context);
print $context->lookup($literal) . "\n";


$myVar = new VariableExpression('input', 'four');
$myVar->interpret($context);
print $context->lookup($myVar) . "\n";

$newVar = new VariableExpression('input');
$newVar->interpret($context);
print $context->lookup($newVar) . "\n";

$myVar->setValue('five');
$myVar->interpret($context);
print $context->lookup($myVar) . "\n";
print $context->lookup($newVar) . "\n";


// 检查
$input = new VariableExpression('input');
$statement = new BooleanOrExpression(
    new EqualsExpression($input, new LiteralExpression('four')),
    new EqualsExpression($input, new LiteralExpression('4'))
);
foreach (['four', '4', '52'] as $val){
    $input->setValue($val);
    print "$val:\n";
    $statement->interpret($context);
    if ($context->lookup($statement)){
        print "top marks\n\n";
    } else {
        print "dunce hat on\n\n";
    }
}