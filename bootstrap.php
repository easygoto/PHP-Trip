<?php

require_once __DIR__ . '/vendor/autoload.php';

ini_set('date.timezone', 'Asia/Shanghai');

defined('TRIP_ROOT') or define('TRIP_ROOT', __DIR__ . '/');
defined('DATA_DIR') or define('DATA_DIR', TRIP_ROOT . 'data/');
defined('VIEW_DIR') or define('VIEW_DIR', TRIP_ROOT . 'src/View/html/');
defined('TEMP_DIR') or define('TEMP_DIR', DATA_DIR . 'temp/');
defined('ASSET_DIR') or define('ASSET_DIR', TRIP_ROOT . 'public/assets/');
defined('ASSET_ICON_DIR') or define('ASSET_ICON_DIR', TRIP_ROOT . 'public/assets/icons/');
defined('ASSET_IMAGE_DIR') or define('ASSET_IMAGE_DIR', TRIP_ROOT . 'public/assets/images/');
defined('UPLOAD_IMAGE_DIR') or define('UPLOAD_IMAGE_DIR', TRIP_ROOT . 'public/upload/images/');
