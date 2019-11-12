<?php


namespace Trink\App\Dp\Command\Demo;

use Exception;
use ReflectionClass;
use ReflectionException;

class CommandFactory
{
    /**
     * @param string $action
     *
     * @return object
     * @throws Exception
     */
    public static function getCommand($action = 'Default')
    {
        if (preg_match('/\W/', $action)) {
            throw new Exception("illegal characters in action");
        }
        $class = ucfirst(strtolower($action)) . 'Command';
        try {
            return (new ReflectionClass('Trink\App\Dp\Command\Demo\Command' . $class))->newInstance();
        } catch (ReflectionException $e) {
            throw new CommandNotFoundException('command is not exists');
        }
    }
}
