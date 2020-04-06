<?php

$extList = [
    'imagick',
    'yaml',
    'yaf',

    'apcu',
    'redis',
    'memcache',
    'memcached',

    'mongodb',

    'amqp',

    'pdo_sqlite',
    'pdo_mysql',
    'pdo_pgsql',

    'xdebug',
    'psr',
    'phalcon',

    'swoole',
    'swoole_async',
    'swoole_orm',
    'swoole_postgresql',
    'swoole_serialize',
];

foreach ($extList as $ext) {
    echo var_export(extension_loaded($ext), true), ": {$ext}\n";
}
