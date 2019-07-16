<?php


namespace Trink\Dp\Command\Demo;

abstract class Command
{
    abstract public function execute(CommandContext $context);
}
