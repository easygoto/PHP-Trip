<?php

require_once __DIR__ . '/vendor/autoload.php';

ini_set('date.timezone', 'Asia/Shanghai');

defined('TRIP_ROOT') or define('TRIP_ROOT', __DIR__ . '/');
defined('DATA_DIR') or define('DATA_DIR', TRIP_ROOT . 'data/');
defined('TEMP_DIR') or define('TEMP_DIR', DATA_DIR . 'temp/');
defined('RESOURCE_DIR') or define('RESOURCE_DIR', TRIP_ROOT . 'public/resource/');
defined('UPLOAD_IMAGE') or define('UPLOAD_IMAGE', TRIP_ROOT . 'public/upload/images/');
