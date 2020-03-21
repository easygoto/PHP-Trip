<?php

$classList = [
    // apcu
    APCUIterator::class,

    // amqp
    AMQPConnection::class,

    // mongo
    MongoDB\Driver\Query::class,

    // redis
    Redis::class,

    // memcached
    Memcached::class,

    // imagick
    ImagickDraw::class,

    // swoole
    Swoole\Coroutine::class,

    // swoole_async
    Swoole\Async::class,

    // swoole_orm
    swoole_orm::class,

    // swoole_postgresql
    Swoole\Coroutine\PostgreSQL::class,
];

foreach ($classList as $class) {
    echo var_export(class_exists($class), true), ": {$class}\n";
}

foreach (PDO::getAvailableDrivers() as $driver) {
    echo "true: pdo_{$driver}\n";
}
