<?php


namespace Tests\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Registry\Demo\Register;

class RegistryTest extends TestCase
{
    public function test()
    {
        $user = json_decode('{"id":1,"name":"Trink","age":24}');

        Register::set('user_1', $user);
        var_dump(Register::get('user_1'));

        Register::unset('user_1');
        var_dump(Register::get('user_1'));

        $this->assertTrue(true);
    }
}