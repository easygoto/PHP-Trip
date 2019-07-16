<?php

namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Decorator\Demo\DiamondDecorator;
use Trink\Dp\Decorator\Demo\Plains;
use Trink\Dp\Decorator\Demo\PolluteDecorator;
use Trink\Dp\Decorator\Demo2\AuthenticateRequest;
use Trink\Dp\Decorator\Demo2\LogRequest;
use Trink\Dp\Decorator\Demo2\MainProcess;
use Trink\Dp\Decorator\Demo2\RequestHelper;
use Trink\Dp\Decorator\Demo2\StructureRequest;

class DecoratorTest extends TestCase
{
    public function test()
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

    public function test2()
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
}
