<?php


namespace Trink\Dp\Factory\Electronics\Phone;


use Trink\Dp\Factory\Electronics\Phone;

class Symbian implements Phone {

    function open(): Phone {
        print "平静自然的开了机 ...\n";
        return $this;
    }

    function call(): Phone {
        print "大声喊叫的打电话 ...\n";
        return $this;
    }
}