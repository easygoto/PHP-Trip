<?php


namespace Test\Trip\Net;

use Trink\Core\Helper\Net\Curl;

class CurlTest extends TestCase
{
    /** @test */
    public function head()
    {
        echo Curl::head($this->returnJsonUrl(), $httpCode);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function options()
    {
        echo Curl::options($this->returnJsonUrl(), $httpCode);
        $this->assertEquals(403, $httpCode);
    }

    /** @test */
    public function get()
    {
        $res = Curl::get(
            $this->returnJsonUrl(),
            http_build_query(['name' => 'name']),
            $httpCode
        );
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function post()
    {
        $res = Curl::post(
            $this->returnJsonUrl(),
            json_encode(['name' => 'name']),
            ['Content-Type: application/json', 'Authorization: ' . md5(microtime())],
            $httpCode
        );
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function put()
    {
        $res = Curl::put(
            $this->returnJsonUrl(),
            json_encode(['name' => 'name']),
            ['Content-Type: application/json'],
            $httpCode
        );
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function patch()
    {
        $res = Curl::patch(
            $this->returnJsonUrl(),
            json_encode(['name' => 'name']),
            ['Content-Type: application/json'],
            $httpCode
        );
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function delete()
    {
        $res = Curl::delete(
            $this->returnJsonUrl(),
            json_encode(['name' => 'name']),
            ['Content-Type: application/json'],
            $httpCode
        );
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }
}
