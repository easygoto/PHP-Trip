<?php

use Singleton\Demo\Preference;

require_once '../autoload.php';

$data = [];
for ($i = 0; $i < 10000; $i ++) {
    $num = Preference::getInstance()->getRnd();
    if (in_array($num, $data)) {
        continue;
    }
    $data[] = $num;
}

print 'ok';
