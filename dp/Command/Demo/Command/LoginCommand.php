<?php

namespace Trink\App\Dp\Command\Demo\Command;

use Trink\App\Dp\Command\Demo\Command;
use Trink\App\Dp\Command\Demo\CommandContext;

class LoginCommand extends Command
{
    public function execute(CommandContext $context)
    {
        $user = $context->get('username');
        $pass = $context->get('pass');
        if ($user != $pass) {
            $context->setError('username and password not matched');
            return false;
        }
        $context->addParam('user', [
            'username' => $user,
            'pass' => $pass
        ]);
        return true;
    }
}
