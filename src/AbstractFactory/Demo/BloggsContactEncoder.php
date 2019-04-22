<?php


namespace Trink\Dp\AbstractFactory\Demo;


class BloggsContactEncoder extends ContactEncoder {
    function encode(){
        return "Contact data encodeed in BloggsCal format\n";
    }
}
