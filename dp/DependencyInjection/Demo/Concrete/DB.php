<?php

namespace Trink\App\Dp\DependencyInjection\Demo\Concrete;

class DB implements \Trink\App\Dp\DependencyInjection\Demo\DB
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function test()
    {
        print __METHOD__ . "\n";
    }
}
