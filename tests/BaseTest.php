<?php

namespace Tests\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Composite\Demo\Archer;
use Trink\Dp\Composite\Demo\Army;
use Trink\Dp\Composite\Demo\LaserCannonUnit;
use Trink\Dp\Composite\Demo\UnitException;
use Trink\Dp\Decorator\Demo\DiamondDecorator;
use Trink\Dp\Decorator\Demo\Plains;
use Trink\Dp\Decorator\Demo\PolluteDecorator;
use Trink\Dp\Decorator\Demo2\AuthenticateRequest;
use Trink\Dp\Decorator\Demo2\LogRequest;
use Trink\Dp\Decorator\Demo2\MainProcess;
use Trink\Dp\Decorator\Demo2\RequestHelper;
use Trink\Dp\Decorator\Demo2\StructureRequest;
use Trink\Dp\Facade\Demo\ProductFacade;
use Trink\Dp\Interpreter\Demo\BooleanOrExpression;
use Trink\Dp\Interpreter\Demo\EqualsExpression;
use Trink\Dp\Interpreter\Demo\InterpreterContext;
use Trink\Dp\Interpreter\Demo\LiteralExpression;
use Trink\Dp\Interpreter\Demo\VariableExpression;
use Trink\Dp\Observer\Demo\Login;
use Trink\Dp\Observer\Demo\SecurityMonitor;
use Trink\Dp\Prototype\Demo\EarthForest;
use Trink\Dp\Prototype\Demo\EarthPlains;
use Trink\Dp\Prototype\Demo\EarthSea;
use Trink\Dp\Prototype\Demo\TerrainFactory;
use Trink\Dp\Strategy\Demo\MarkLogicMarker;
use Trink\Dp\Strategy\Demo\MatchMarker;
use Trink\Dp\Strategy\Demo\RegexMarker;
use Trink\Dp\Strategy\Demo\TextQuestion;

class BaseTest extends TestCase
{
    public function testAbstractFactoryDemo()
    {
        $this->assertTrue(true);
    }

    public function testCompositeDemo()
    {
        try {
            $mainArmy = new Army();
            $mainArmy->addUnit(new Archer());
            $mainArmy->addUnit(new LaserCannonUnit());
            $mainArmy->addUnit(new LaserCannonUnit());
            print $mainArmy->bombardStrength();
            print "\n";

            $subArmy = new Army();
            $subArmy->addUnit(new Archer());
            $subArmy->addUnit(new Archer());
            $subArmy->addUnit(new Archer());
            $mainArmy->addUnit($subArmy);
            print $mainArmy->bombardStrength();
            print "\n";
        } catch (UnitException $exception) {
            $exception->getMessage();
        }
        $this->assertTrue(true);
    }

    public function testDecoratorDemo()
    {
        $tile = new Plains();
        print $tile->getWealthFactor();
        print "\n";

        $tile = new DiamondDecorator(new Plains());
        print $tile->getWealthFactor();
        print "\n";

        $tile = new PolluteDecorator(new DiamondDecorator(new Plains()));
        print $tile->getWealthFactor();
        print "\n";
        $this->assertTrue(true);
    }

    public function testDecoratorDemo2()
    {
        $process = new AuthenticateRequest(
            new StructureRequest(
                new LogRequest(
                    new MainProcess()
                )
            )
        );
        $process->process(new RequestHelper());
        $this->assertTrue(true);
    }

    public function testFacadeDemo()
    {
        $facade = new ProductFacade('facade.txt');
        var_dump($facade->getProduct(234));
        $this->assertTrue(true);
    }

    public function testInterpreterDemo()
    {
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
        $input     = new VariableExpression('input');
        $statement = new BooleanOrExpression(
            new EqualsExpression($input, new LiteralExpression('four')),
            new EqualsExpression($input, new LiteralExpression('4'))
        );
        foreach (['four', '4', '52'] as $val) {
            $input->setValue($val);
            print "$val:\n";
            $statement->interpret($context);
            if ($context->lookup($statement)) {
                print "top marks\n\n";
            } else {
                print "dunce hat on\n\n";
            }
        }
        $this->assertTrue(true);
    }

    public function testObserverDemo()
    {
        $login = new Login();
        $login->attach(new SecurityMonitor());
        $this->assertTrue(true);
    }

    public function testPrototypeDemo()
    {
        $factory = new TerrainFactory(
            new EarthSea(),
            new EarthForest(),
            new EarthPlains()
        );
        var_dump($factory->getSea());
        var_dump($factory->getPlains());
        var_dump($factory->getForest());
        $this->assertTrue(true);
    }

    public function testStrategyDemo()
    {
        $markers = [
            new RegexMarker("/f.ve/"),
            new MatchMarker("five"),
            new MarkLogicMarker('$input equals "five"'),
        ];
        foreach ($markers as $marker) {
            print get_class($marker) . "\n";
            $question = new TextQuestion("how many beans make five", $marker);
            foreach (['five', 'four'] as $response) {
                print "\tresponse: $response: ";
                if ($question->mark($response)) {
                    print "well done\n";
                } else {
                    print "never mind\n";
                }
            }
        }
        $this->assertTrue(true);
    }
}
