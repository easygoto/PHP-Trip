<?php

namespace Trink\App\Dp\Factory\Electronics\Phone;

class Andriod implements Operate
{
    public function open()
    {
        print "迫不及待的开了机 ...\n";
    }

    public function call()
    {
        print "戴着耳机打电话 ...\n";
    }
}
