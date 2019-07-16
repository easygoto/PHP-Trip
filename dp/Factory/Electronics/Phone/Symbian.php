<?php


namespace Trink\Dp\Factory\Electronics\Phone;

use Trink\Dp\Factory\Electronics\Phone;

class Symbian implements Phone
{
    public function open(): Phone
    {
        print "平静自然的开了机 ...\n";
        return $this;
    }

    public function call(): Phone
    {
        print "大声喊叫的打电话 ...\n";
        return $this;
    }
}
