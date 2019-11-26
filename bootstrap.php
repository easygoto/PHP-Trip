<?php

require_once __DIR__ . '/vendor/autoload.php';

defined('TRIP_ROOT') or define('TRIP_ROOT', str_replace('\\', '/', __DIR__) . '/');
defined('DATA_DIR') or define('DATA_DIR', TRIP_ROOT . 'data/');
defined('TEMP_DIR') or define('TEMP_DIR', DATA_DIR . 'temp/');
defined('RESOURCE_DIR') or define('RESOURCE_DIR', TRIP_ROOT . 'public/resource/');
