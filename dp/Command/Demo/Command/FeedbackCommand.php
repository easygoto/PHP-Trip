<?php


namespace Trink\Dp\Command\Demo\Command;

use Trink\Dp\Command\Demo\Command;
use Trink\Dp\Command\Demo\CommandContext;

class FeedbackCommand extends Command
{
    public function execute(CommandContext $context)
    {
        $email  = $context->get('email');
        $msg    = $context->get('msg');
        $topic  = $context->get('topic');
        $result = $email && $msg && $topic;
        if (!$result) {
            $context->setError('less params');
            return false;
        }
        return true;
    }
}
