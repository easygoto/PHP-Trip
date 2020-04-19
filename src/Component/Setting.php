<?php

namespace Trink\Frame\Component;

use Dotenv\Dotenv;
use Trink\Core\Helper\Arrays;

class Setting
{
    protected array $props;

    public function __construct()
    {
        Dotenv::createMutable(TRIP_ROOT)->load();
        $this->initDefault();
    }

    public function set(string $key, $value)
    {
        $this->props[$key] = $value;
    }

    public function get(string $key = null)
    {
        return Arrays::get($this->props, $key);
    }

    public function initDefault()
    {
        $this->props = [
            'host' => $_ENV['APP_HOST'],
            'debug' => $_ENV['APP_DEBUG'],
            'db' => [
                'type' => 'mysql',
                'host' => $_ENV['MYSQL_HOST'],
                'user' => $_ENV['MYSQL_USERNAME'],
                'pass' => $_ENV['MYSQL_PASSWORD'],
                'dbname' => $_ENV['MYSQL_DBNAME'],
                'port' => $_ENV['MYSQL_PORT'],
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
            ],
            'redis' => [
                'host' => $_ENV['REDIS_HOST'],
                'port' => $_ENV['REDIS_PORT'],
                'pass' => $_ENV['REDIS_PASSWORD'],
            ],
            'rabbit' => [
                'host' => $_ENV['RABBITMQ_HOST'],
                'port' => $_ENV['RABBITMQ_PORT'],
                'login' => $_ENV['RABBITMQ_USERNAME'],
                'password' => $_ENV['RABBITMQ_PASSWORD'],
                'vhost' => $_ENV['RABBITMQ_VHOST'],
            ],
            'mc' => [
                'host' => $_ENV['MEMCACHED_HOST'],
                'port' => $_ENV['MEMCACHED_PORT'],
                'prefix' => $_ENV['MEMCACHED_PREFIX'],
            ],
        ];
    }
}
