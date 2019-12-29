<?php

return [
    'host'   => 'cli.trink.com',
    'debug'  => true,
    'db'     => require 'db.php',
    'redis'  => require 'redis.php',
    'rabbit' => require 'rabbit.php',
    'mc'     => [
        'host' => 'host.docker.internal',
        'port' => 11211,
    ],
];
