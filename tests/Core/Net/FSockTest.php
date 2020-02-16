<?php


namespace Test\Trip\Core\Net;

use Trink\Core\Helper\Net\FOpen;

class FSockTest extends TestCase
{
    /** @test */
    public function httpHead()
    {
        echo FOpen::head($this->hostname(), $this->returnJsonPath());
        $this->assertTrue(true);
    }

    /** @test */
    public function httpGet()
    {
        echo FOpen::get($this->hostname(), $this->returnJsonPath(), http_build_query(['name' => '中文']));
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPost()
    {
        echo FOpen::post(
            $this->hostname(),
            $this->returnJsonPath(),
            json_encode(['name' => '中文']),
            ['headers' => ['Content-Type: application/json']]
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPatch()
    {
        echo FOpen::patch(
            $this->hostname(),
            $this->returnJsonPath(),
            json_encode(['name' => '中文']),
            ['headers' => ['Content-Type: application/json']]
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpDelete()
    {
        echo FOpen::delete(
            $this->hostname(),
            $this->returnJsonPath(),
            json_encode(['name' => '中文']),
            ['headers' => ['Content-Type: application/json']]
        );
        $this->assertTrue(true);
    }
}
