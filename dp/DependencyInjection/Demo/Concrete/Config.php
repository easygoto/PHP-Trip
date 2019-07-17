<?php


namespace Trink\Dp\DependencyInjection\Demo\Concrete;

class Config implements \Trink\Dp\DependencyInjection\Demo\Config
{
    public function test()
    {
        print __METHOD__ . "\n";
    }
}
