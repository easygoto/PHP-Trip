<?php

namespace Test\Trip\Core\Net;

use Trink\Core\Helper\Net\Stream;

class StreamTest extends TestCase
{
    /** @test */
    public function httpHead()
    {
        echo Stream::head($this->hostname(), $this->returnJsonPath());
        $this->assertTrue(true);
    }

    /** @test */
    public function httpGet()
    {
        echo Stream::get($this->hostname(), $this->returnJsonPath(), http_build_query(['name' => '中文']));
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPost()
    {
        echo Stream::post(
            $this->hostname(),
            $this->returnJsonPath(),
            http_build_query(['name' => '中文']),
            ['headers' => ['Content-Type: application/json']]
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpPatch()
    {
        echo Stream::patch(
            $this->hostname(),
            $this->returnJsonPath(),
            json_encode(['name' => '中文']),
            ['Content-Type: application/json']
        );
        $this->assertTrue(true);
    }

    /** @test */
    public function httpDelete()
    {
        echo Stream::delete(
            $this->hostname(),
            $this->returnJsonPath(),
            json_encode(['name' => '中文']),
            ['Content-Type: application/json']
        );
        $this->assertTrue(true);
    }
}
