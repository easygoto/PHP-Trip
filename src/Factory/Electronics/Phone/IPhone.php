<?php


namespace Trink\Dp\Factory\Electronics\Phone;


use Trink\Dp\Factory\Electronics\Phone;

class IPhone implements Phone {

    function open(): Phone {
        print "欣喜若狂的开了机 ...\n";
        return $this;
    }

    function call(): Phone {
        print "开着免提打电话 ...\n";
        return $this;
    }
}