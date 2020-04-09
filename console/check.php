<?php

$extList = [
    'apcu',
    'redis',
    'memcache',
    'memcached',
    'mongodb',
    'amqp',

    'pdo_sqlite',
    'pdo_mysql',
    'pdo_pgsql',

    'imagick',
    'yaml',
    'psr',
    'yaf',

    'xdebug',
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
