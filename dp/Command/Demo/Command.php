<?php


namespace Trink\App\Dp\Command\Demo;

abstract class Command
{
    abstract public function execute(CommandContext $context);
}
