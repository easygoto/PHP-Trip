<?php

namespace Trink\App\Trip\Limiting;

use Redis;
use Trink\Core\Helper\Arrays;
use Trink\Frame\Container\App;

class TokenBucket
{
    private int $max = 10;

    private string $tokenKey = 'default:queue:token';

    private ?Redis $redis = null;

    private static ?TokenBucket $instance = null;

    public static function instance()
    {
        if (!self::$instance || !(self::$instance instanceof TokenBucket)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct(array $options = [])
    {
        $this->connect();
        $this->tokenKey = Arrays::get($options, 'prefix', $this->tokenKey);
    }

    private function connect()
    {
        $redisCnf = App::instance()->setting->get('redis');
        $this->redis = new Redis();
        $this->redis->pconnect($redisCnf['host'], $redisCnf['port']);
        $this->redis->auth($redisCnf['pass']);
    }

    public function add()
    {
        $freeLen = $this->max - $this->redis->lLen($this->tokenKey);
        if ($freeLen < 1) {
            return false;
        }
        return (bool)$this->redis->lPush($this->tokenKey, md5(uniqid(microtime())));
    }

    public function addByNum(int $num = 1)
    {
        for ($i = 0; $i < $num; $i++) {
            $this->add();
        }
    }

    public function get()
    {
        return $this->redis->rPop($this->tokenKey);
    }

    public function reset()
    {
        $this->redis->del($this->tokenKey);
        $this->addByNum($this->max);
    }
}
