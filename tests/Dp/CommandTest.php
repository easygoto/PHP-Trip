<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\Command\Demo\Command\FeedbackCommand;
use Trink\App\Dp\Command\Demo\Command\LoginCommand;
use Trink\App\Dp\Command\Demo\CommandContext;

class CommandTest extends TestCase
{
    /** @test */
    public function login()
    {
        $context = new CommandContext();
        $result  = (new LoginCommand())->execute(
            $context
                ->addParam('username', 'root')
                ->addParam('pass', 'root')
        );
        if (!$result) {
            var_dump($context->getError());
        }
        $this->assertTrue(true);
    }

    /** @test */
    public function feedback()
    {
        $context = new CommandContext();
        $result  = (new FeedbackCommand())->execute(
            $context
                ->addParam('email', 'email')
                ->addParam('msg', 'this is msg')
                ->addParam('topic', 'this is topic')
        );
        if (!$result) {
            var_dump($context->getError());
        }
        $this->assertTrue(true);
    }
}
