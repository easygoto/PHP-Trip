<?php


namespace Test\Net;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function baseUrl()
    {
        return 'http://192.168.0.173/test-http/';
    }

    public function returnJsonUrl()
    {
        return $this->baseUrl() . 'apis/return_json.php';
    }
}
