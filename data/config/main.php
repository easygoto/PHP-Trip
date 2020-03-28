<?php

return [
    'host' => 'make.trink.com',
    'debug' => true,
    'db' => [
        'type' => 'mysql',
        'host' => 'host.docker.internal',
        'user' => 'root',
        'pass' => '123123',
        'dbname' => 'test',
        'port' => 3306,
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ],
    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'pass' => '123123',
    ],
    'rabbit' => [
        'host' => 'host.docker.internal',
        'port' => 5672,
        'login' => 'admin',
        'password' => '123123',
        'vhost' => '/demo',
    ],
    'mc' => [
        'host' => 'host.docker.internal',
        'port' => 11211,
        'prefix' => '',
    ],
];
