<?php


namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\DependencyInjection\Demo\App;

class DependencyInjectionTest extends TestCase
{
    public function test()
    {
        $app = App::instance();

        $db = $app->db;
        $db->test();

        $log = $app->log;
        $log->test();

        $config = $app->config;
        $config->test();

        $this->assertTrue(true);
    }
}
