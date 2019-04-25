<?php


namespace Trink\Dp\Factory\Electronics\Phone;

use Trink\Dp\Factory\Electronics\Phone;

class IOS implements Phone
{
    public function open(): Phone
    {
        print "欣喜若狂的开了机 ...\n";
        return $this;
    }

    public function call(): Phone
    {
        print "开着免提打电话 ...\n";
        return $this;
    }
}
