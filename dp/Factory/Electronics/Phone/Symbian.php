<?php


namespace Trink\Dp\Factory\Electronics\Phone;

class Symbian implements Operate
{
    public function open()
    {
        print "平静自然的开了机 ...\n";
    }

    public function call()
    {
        print "大声喊叫的打电话 ...\n";
    }
}
