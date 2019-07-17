<?php


namespace Trink\Dp\DependencyInjection\Demo\Concrete;

class Log implements \Trink\Dp\DependencyInjection\Demo\Log
{
    public function test()
    {
        print __METHOD__ . "\n";
    }
}
