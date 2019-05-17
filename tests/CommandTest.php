<?php


namespace Tests\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Command\Demo\Command\LoginCommand;
use Trink\Dp\Command\Demo\CommandContext;

class CommandTest extends TestCase
{
    public function test()
    {
        $result = (new LoginCommand)->execute(
            (new CommandContext)
                ->addParam('username', 'root')
                ->addParam('pass', 'root')
        );
        var_dump($result);
        $this->assertTrue(true);
    }
}
