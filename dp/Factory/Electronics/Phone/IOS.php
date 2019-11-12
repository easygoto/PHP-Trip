<?php


namespace Trink\App\Dp\Factory\Electronics\Phone;

class IOS implements Operate
{
    public function open()
    {
        print "欣喜若狂的开了机 ...\n";
    }

    public function call()
    {
        print "开着免提打电话 ...\n";
    }
}
