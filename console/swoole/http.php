<?php

use Trink\Core\Component\Swoole\HttpServer;

require_once __DIR__ . '/../../bootstrap.php';

(new HttpServer())->run();
