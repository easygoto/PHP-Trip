<?php

use Trink\Core\Component\Swoole\WsServer;

require_once __DIR__ . '/../../bootstrap.php';

(new WsServer())->run();
