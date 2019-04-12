<?php

require_once '../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Trink\Singleton\Config\Config;
use Trink\Singleton\Demo\Preference;

class SingletonTest extends TestCase {

    public function testDemo() {
        $data = [];
        for ($i = 0; $i < 10000; $i ++) {
            $num = Preference::getInstance()->getRnd();
            if (in_array($num, $data)) {
                continue;
            }
            $data[] = $num;
        }
        $this->assertCount(1, $data);
    }

    public function testConfig() {
        $db = Config::instance()->db;
        var_dump($db);
        $this->assertIsArray($db);
    }
}
