<?php


namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\DependencyInjection\Demo\Application;
use Trink\Dp\DependencyInjection\Demo\DatabaseConfiguration;
use Trink\Dp\DependencyInjection\Demo\DatabaseConnection;

class DependencyInjectionTest extends TestCase
{
    public function test()
    {
        $config     = new DatabaseConfiguration('localhost', 3306, 'root', '1234');
        $connection = new DatabaseConnection($config);

        $this->assertEquals('root:1234@localhost:3306', $connection->getDsn());
    }

    public function test2()
    {
        $app = new Application();
        $config = $app->config;
        var_dump($config);
        $this->assertTrue(true);
    }
}
