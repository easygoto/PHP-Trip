<?php


namespace Test\Trip\App\Demo;

use Redis;
use Test\Trip\TestCase;

class RedisTest extends TestCase
{
    public function test()
    {
        $redis = new Redis();
        $redis->pconnect('host.docker.internal', 6379);
        $redis->auth('123123');
        $redis->set("string-name", "Redis Tree Link ...");
        print sprintf("Stored string in redis: %s\n\n", $redis->get("string-name"));

        $redis->lpush("list-name", "Redis");
        $redis->lpush("list-name", "Mongodb");
        $redis->lpush("list-name", "Mysql");
        print_r($redis->lrange("list-name", 0, 20));
        print "\n";

        print "Stored keys in redis::";
        print_r($redis->keys("*"));
        $this->assertTrue(true);
    }
}
