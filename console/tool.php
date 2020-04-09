<?php

require_once __DIR__ . '/../bootstrap.php';

$filename = TEMP_DIR . 'ab/php-fpm.c50.n500.log';
$result = exec('ab -c 1 -n 1 http://make.trink.com/ > ' . $filename);
