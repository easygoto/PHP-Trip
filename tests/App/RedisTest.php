<?php

namespace Test\Trip\App;

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
    public function publish()
    {
        do {
            $i = $i ?? 0;
            $data = json_encode(['time' => date('Y-m-d H:i:s'), 'message' => md5(uniqid(microtime()))]);
            if ($i % 2 == 0) {
                $this->redis->publish('test:redis', $data);
            } elseif ($i % 3 == 0) {
                $this->redis->publish('test:mongodb', $data);
            } elseif ($i % 5 == 0) {
                $this->redis->publish('test:swoole', $data);
            } elseif ($i % 7 == 0) {
                $this->redis->publish('test:memcached', $data);
            } elseif ($i % 11 == 0) {
                $this->redis->publish('test:nginx', $data);
            } elseif ($i % 13 == 0) {
                $this->redis->publish('test:rabbitmq', $data);
            } elseif ($i % 17 == 0) {
                $this->redis->publish('test:mysql', $data);
            } else {
                $this->redis->publish('test:linux', $data);
            }
            sleep(1);
            $i++;
        } while (true);
        $this->assertTrue(true);
    }

    /** @test */
    public function subscribe()
    {
        $this->redis->subscribe([
            'test:mongodb',
            'test:redis',
            'test:swoole',
            'test:memcached',
            'test:nginx',
            'test:rabbitmq',
            'test:mysql',
        ], function ($redis, $channel, $msg) {
            ob_flush();
            flush();
            Logger::println("{$channel}: ");
            Logger::println($msg);
            Logger::println('');
        });
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
