<?php

namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Observer\Demo\Login;
use Trink\Dp\Observer\Demo\SecurityMonitor;

class ObserverTest extends TestCase
{
    public function test()
    {
        $login = new Login();
        $login->attach(new SecurityMonitor());
        $this->assertTrue(true);
    }
}
