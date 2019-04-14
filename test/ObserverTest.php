<?php

use PHPUnit\Framework\TestCase;
use Trink\Observer\Demo\Login;
use Trink\Observer\Demo\SecurityMonitor;

require_once '../vendor/autoload.php';

class ObserverTest extends TestCase {

    public function testDemo() {
        $login = new Login();
        $login->attach(new SecurityMonitor());
        $this->assertTrue(true);
    }
}
