<?php


namespace Test\Trip\App\Demo;

use Redis;
use Test\Trip\TestCase;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class RedisTest extends TestCase
{
    private Redis $redis;

    /** @before */
    public function init()
    {
        parent::init();
        $redisCnf = App::instance()->setting->get('redis');
        $this->redis = new Redis();
        $this->redis->pconnect($redisCnf['host'], $redisCnf['port']);
        $this->redis->auth($redisCnf['pass']);
    }

    public function test()
    {
        Logger::print("Stored keys in redis::");
        Logger::println($this->redis->keys("*"));
        $this->assertTrue(true);
    }

    /** @test */
    public function geo()
    {
        // 添加
        $this->redis->geoadd('geo:mall', 120.832485, 30.325233, 'shop:1');
        $this->redis->geoadd('geo:mall', 118.388191, 28.121192, 'shop:2');
        $this->redis->geoadd('geo:mall', 112.977089, 28.183483, 'shop:3');
        $this->redis->geoadd('geo:mall', 117.329939, 29.440291, 'user:1');

        // 获取定位
        $log = $this->redis->geopos('geo:mall', 'shop:3');
        Logger::println($log);

        // 两点计算距离
        $log = $this->redis->geodist('geo:mall', 'shop:1', 'shop:2', 'km');
        Logger::println($log);

        // 300 km 以内
        $options = ['WITHDIST', 'ASC', 'count' => 2];
        $log = $this->redis->georadius('geo:mall', 116.393874, 29.278394, 400, 'km', $options);
        Logger::println($log);
        $log = $this->redis->georadiusbymember('geo:mall', 'user:1', 400, 'km', $options);
        Logger::println($log);
        $this->assertTrue(true);
    }
}
