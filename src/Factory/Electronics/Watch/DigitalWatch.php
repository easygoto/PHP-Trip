<?php


namespace Trink\Dp\Factory\Electronics\Watch;


use Trink\Dp\Factory\Electronics\Watch;

class DigitalWatch implements Watch {

    function run(): Watch {
        print "无声无息的跳动 ...\n";
        return $this;
    }
}