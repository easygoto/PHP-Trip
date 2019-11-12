<?php


namespace Trink\App\Dp\DependencyInjection\Demo\Concrete;

class Config implements \Trink\App\Dp\DependencyInjection\Demo\Config
{
    public function test()
    {
        print __METHOD__ . "\n";
    }
}
