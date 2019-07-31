<?php


namespace Test\Trip;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected static $resDir;

    /** @before */
    public function init()
    {
        require_once __DIR__ . '/../bootstrap.php';
        self::$resDir = TRIP_ROOT . 'res/';
    }
}
