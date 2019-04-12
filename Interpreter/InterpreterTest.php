<?php

use Interpreter\Demo\BooleanOrExpression;
use Interpreter\Demo\EqualsExpression;
use Interpreter\Demo\InterpreterContext;
use Interpreter\Demo\LiteralExpression;
use Interpreter\Demo\VariableExpression;

require_once '../vendor/autoload.php';

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