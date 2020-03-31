<?php

namespace Test\Trip\App;

use Redis;
use Test\Trip\TestCase;
use Trink\Core\Component\Logger;
use Trink\Frame\Container\App;

class RedisTest extends TestCase
{
    private ?Redis $redis;

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
        $this->redis->subscribe(
            [
                'test:mongodb',
                'test:redis',
                'test:swoole',
                'test:memcached',
                'test:nginx',
                'test:rabbitmq',
                'test:mysql',
            ],
            function ($redis, $channel, $msg) {
                ob_flush();
                flush();
                Logger::println("{$channel}: ");
                Logger::println($msg);
                Logger::println('');
            }
        );
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

    /** @test */
    public function bitmap()
    {
        $keyList = [];
        for ($i = 7; $i > 0; $i--) {
            $key = "user:login:" . date('Y_m_d', time() - 86400 * $i);
            // 模拟大数据 32 char = 32 byte = 256 bit
            $this->redis->set($key, str_shuffle(str_repeat(md5(uniqid(microtime())), 1e5)));
            $keyList[] = $key;
        }

        // 手动设置, 以防测试不出
        $this->redis->setBit($keyList[0], 3562214, 1);
        $this->redis->setBit($keyList[1], 3562214, 1);
        $this->redis->setBit($keyList[2], 3562214, 1);
        $this->redis->setBit($keyList[3], 3562214, 1);
        $this->redis->setBit($keyList[4], 3562214, 1);
        $this->redis->setBit($keyList[5], 3562214, 1);
        $this->redis->setBit($keyList[6], 3562214, 1);

        // 统计某用户是否这七天连续登录
        Logger::println(
            $this->redis->bitOp(
                'AND',
                'user:login:temp_stat',
                $keyList[0],
                $keyList[1],
                $keyList[2],
                $keyList[3],
                $keyList[4],
                $keyList[5],
                $keyList[6]
            )
        );
        Logger::println($this->redis->getBit('user:login:temp_stat', 3562214));
        $this->assertTrue(true);
    }

    /** @test */
    public function hyper()
    {
        $keyList = [];
        for ($i = 7; $i > 0; $i--) {
            $key = 'user:id:' . date('Y_m_d', time() - 86400 * $i);
            $keyList[] = $key;
            for ($j = 1e3; $j > 0; $j--) {
                $str = md5(uniqid(microtime()));
                $this->redis->pfAdd(
                    $key,
                    [
                        substr($str, 0, 4),
                        substr($str, 4, 4),
                        substr($str, 8, 4),
                        substr($str, 12, 4),
                        substr($str, 16, 4),
                        substr($str, 20, 4),
                        substr($str, 24, 4),
                        substr($str, 28, 4),
                    ]
                );
            }
        }

        $this->redis->pfMerge('user:id:stat', $keyList);
        Logger::println($this->redis->pfCount($keyList[0]));
        Logger::println($this->redis->pfCount('user:id:stat'));
        $this->assertTrue(true);
    }

    /** @test */
    public function pipeline()
    {
        $start = microtime(true);
        for ($i = 1e4; $i > 0; $i--) {
            $this->redis->set('test:pipeline1:' . $i, md5(uniqid(microtime())));
        }
        $end = microtime(true);
        Logger::println('total time: ' . ($end - $start));

        $start = microtime(true);
        for ($i = 1e4; $i > 0; $i -= 100) {
            $this->redis->pipeline();
            for ($j = 100; $j > 0; $j--) {
                $this->redis->set('test:pipeline2:' . ($i - $j), md5(uniqid(microtime())));
            }
            $this->redis->exec();
        }
        $end = microtime(true);
        Logger::println('total time: ' . ($end - $start));
        $this->assertTrue(true);
    }
}
