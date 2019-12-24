<?php


namespace Test\Trip\Net;

class TestCase extends \PHPUnit\Framework\TestCase
{
    const DEFAULT_ENV = 'dev';

    public function hostname($env = self::DEFAULT_ENV)
    {
        switch ($env) {
            default:
            case 'test':
                return 'cli.trink.com';
            case 'dev':
                return '192.168.0.173';
        }
    }

    public function returnJsonPath($env = self::DEFAULT_ENV)
    {
        switch ($env) {
            default:
            case 'test':
                return '/apis/return_json.php';
            case 'dev':
                return '/test-http/apis/return_json.php';
        }
    }

    public function returnJsonUrl($env = self::DEFAULT_ENV)
    {
        return 'http://' . $this->hostname($env) . $this->returnJsonPath($env);
    }
}
