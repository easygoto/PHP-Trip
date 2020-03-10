<?php

namespace Trink\App\Dp\AbstractFactory\Demo;

class BloggsContactEncoder extends ContactEncoder
{
    public function encode()
    {
        return "Contact data encodeed in BloggsCal format\n";
    }
}
