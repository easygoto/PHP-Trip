<?php


namespace Trink\Dp\DependencyInjection\Demo;

/**
 * @property DatabaseConfiguration config
 */
class Application
{
    public function __construct()
    {
    }

    public function __get($name)
    {
        if ($name == 'config') {
            return new DatabaseConfiguration('', 0, '', '');
        }
        return null;
    }
}
