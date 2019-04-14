<?php

use PHPUnit\Framework\TestCase;
use Trink\Interpreter\Demo\BooleanOrExpression;
use Trink\Interpreter\Demo\EqualsExpression;
use Trink\Interpreter\Demo\InterpreterContext;
use Trink\Interpreter\Demo\LiteralExpression;
use Trink\Interpreter\Demo\VariableExpression;

require_once '../vendor/autoload.php';

class InterpreterTest extends TestCase {

    public function testDemo() {
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
        $this->assertTrue(true);
    }
}
