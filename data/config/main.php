<?php

return [
    'host'   => 'cli.trink.com',
    'debug'  => true,
    'db'     => require_once 'db.php',
    'redis'  => require_once 'redis.php',
    'rabbit' => require_once 'rabbit.php',
];
