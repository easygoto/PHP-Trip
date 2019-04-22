<?php


use PHPUnit\Framework\TestCase;
use Trink\Dp\Composite\Demo\Archer;
use Trink\Dp\Composite\Demo\Army;
use Trink\Dp\Composite\Demo\LaserCannonUnit;
use Trink\Dp\Composite\Demo\UnitException;
use Trink\Dp\Facade\Demo\ProductFacade;
use Trink\Dp\FactoryMethod\Demo\BloggsCommsManager;
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
use Trink\Dp\Singleton\Config\Config;
use Trink\Dp\Singleton\Demo\Preference;
use Trink\Dp\Strategy\Demo\MarkLogicMarker;
use Trink\Dp\Strategy\Demo\MatchMarker;
use Trink\Dp\Strategy\Demo\RegexMarker;
use Trink\Dp\Strategy\Demo\TextQuestion;


require_once '../vendor/autoload.php';


class BaseTest extends TestCase {

    public function testAbstractFactoryDemo() {
        $this->assertTrue(true);
    }

    public function testCompositeDemo() {
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

    public function testFacadeDemo() {
        $facade = new ProductFacade('facade.txt');
        var_dump($facade->getProduct(234));
        $this->assertTrue(true);
    }

    public function testFactoryMethodDemo() {
        $bcm = new BloggsCommsManager();
        echo $bcm->getHeaderText();
        var_dump($bcm->getApptEncoder());
        echo $bcm->getFooterText();
        $this->assertTrue(true);
    }

    public function testInterpreterDemo() {
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

    public function testObserverDemo() {
        $login = new Login();
        $login->attach(new SecurityMonitor());
        $this->assertTrue(true);
    }

    public function testPrototypeDemo() {
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

    public function testSingletonDemo() {
        $data = [];
        for ($i = 0; $i < 10000; $i ++) {
            $num = Preference::getInstance()->getRnd();
            if (in_array($num, $data)) {
                continue;
            }
            $data[] = $num;
        }
        $this->assertCount(1, $data);
    }

    public function testSingletonConfig() {
        $db = Config::instance()->db;
        var_dump($db);
        $this->assertIsArray($db);
    }

    public function testStrategyDemo() {
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