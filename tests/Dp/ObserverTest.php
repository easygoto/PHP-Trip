<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\Observer\Demo\Login;
use Trink\App\Dp\Observer\Demo\SecurityMonitor;

class ObserverTest extends TestCase
{
    public function test()
    {
        $login = new Login();
        $login->attach(new SecurityMonitor());
        $this->assertTrue(true);
    }
}
