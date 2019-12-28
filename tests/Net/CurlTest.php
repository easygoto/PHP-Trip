<?php


namespace Test\Trip\Net;

use Test\Trip\TestCase;

class CurlTest extends TestCase
{
    /** @test */
    public function head()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function options()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertEquals(403, $httpCode);
    }

    /** @test */
    public function get()
    {
        $url = $this->returnJsonUrl() . '?' . http_build_query(['name' => 'name']);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function post()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => 'name']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: ' . md5(microtime())]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function put()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => 'name']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function patch()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => 'name']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }

    /** @test */
    public function delete()
    {
        $ch = curl_init($this->returnJsonUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => 'name']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $res;
        $this->assertJson($res);
        $this->assertEquals(200, $httpCode);
    }
}
