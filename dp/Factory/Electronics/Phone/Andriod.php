<?php


namespace Trink\Dp\Factory\Electronics\Phone;

use Trink\Dp\Factory\Electronics\Phone;

class Andriod implements Phone
{
    public function open(): Phone
    {
        print "迫不及待的开了机 ...\n";
        return $this;
    }

    public function call(): Phone
    {
        print "戴着耳机打电话 ...\n";
        return $this;
    }
}