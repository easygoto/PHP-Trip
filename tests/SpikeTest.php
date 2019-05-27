<?php


namespace Test\Demo;

use PHPUnit\Framework\TestCase;

class SpikeTest extends TestCase
{
    /** @test */
    public function mysql()
    {
        require_once __DIR__ . '/spike/mysql.php';
        $this->assertTrue(true);
    }
}
