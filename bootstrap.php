<?php

require_once __DIR__ . '/vendor/autoload.php';

ini_set('date.timezone', 'Asia/Shanghai');

defined('TRIP_ROOT') or define('TRIP_ROOT', __DIR__ . '/');
defined('DATA_DIR') or define('DATA_DIR', TRIP_ROOT . 'data/');
defined('TEMP_DIR') or define('TEMP_DIR', DATA_DIR . 'temp/');
defined('ASSET_DIR') or define('ASSET_DIR', TRIP_ROOT . 'public/assets/');
defined('UPLOAD_IMAGE_DIR') or define('UPLOAD_IMAGE_DIR', TRIP_ROOT . 'public/upload/images/');
