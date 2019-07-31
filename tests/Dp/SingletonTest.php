<?php


namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\Dp\Singleton\Config\Config;

class SingletonTest extends TestCase
{
    /**
     * @test
     * @group config
     */
    public function app()
    {
        $config1 = Config::instance();
        $app    = $config1->app;
        var_dump($app);
        $this->assertNull($app);

        $config2 = Config::instance();
        $config2->app = [
            'id' => 'dp_singleton_config_app',
        ];

        $config3 = Config::instance();
        $app    = $config3->app;
        var_dump($app);

        $this->assertArrayHasKey('id', $app);
        $this->assertSame($config1, $config2);
        $this->assertSame($config3, $config2);
    }

    /**
     * @test
     * @group config
     */
    public function db()
    {
        $config = Config::instance();
        $db     = $config->db;
        var_dump($db);
        $this->assertIsArray($db);
        $this->assertEquals($db['host'] ?? 'localhost', 'localhost');
    }
}
