<?php


namespace Trink\Dp\Factory\Electronics\Watch;


use Trink\Dp\Factory\Electronics\Watch;

class QuartzWatch implements Watch {

    function run(): Watch {
        print "咔嚓，咔嚓嚓嚓嚓 ...\n";
        return $this;
    }
}