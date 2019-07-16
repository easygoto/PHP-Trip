<?php


namespace Test\Trip\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Singleton\Config\Config;

class SingletonTest extends TestCase
{
    /**
     * @test
     * @group config
     */
    public function app()
    {
        $config = Config::instance();
        $app    = $config->app;
        var_dump($app);
        $this->assertNull($app);

        $config = Config::instance();
        $config->app = [
            'id' => 'dp_singleton_config_app',
        ];

        $config = Config::instance();
        $app    = $config->app;
        var_dump($app);
        $this->assertArrayHasKey('id', $app);
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
