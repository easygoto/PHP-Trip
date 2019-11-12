<?php


namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\State\Demo\ContextOrder;
use Trink\App\Dp\State\Demo\CreateOrder;

class StateTest extends TestCase
{
    public function test()
    {
        $order        = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();

        $this->assertEquals('shipping', $contextOrder->getStatus());
    }

    public function test2()
    {
        $order        = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();
        $contextOrder->done();

        $this->assertEquals('completed', $contextOrder->getStatus());
    }
}
