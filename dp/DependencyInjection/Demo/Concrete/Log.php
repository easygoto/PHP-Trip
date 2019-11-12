<?php


namespace Trink\App\Dp\DependencyInjection\Demo\Concrete;

class Log implements \Trink\App\Dp\DependencyInjection\Demo\Log
{
    public function test()
    {
        print __METHOD__ . "\n";
    }
}
