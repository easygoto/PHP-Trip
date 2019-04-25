<?php


namespace Trink\Dp\Factory\Electronics\Computer;

use Trink\Dp\Factory\Electronics\Computer;

class PC implements Computer
{
    public function run(): Computer
    {
        print "台式电脑启动 ...\n";
        return $this;
    }

    public function play(): Computer
    {
        print "啥游戏都能玩 ...\n";
        return $this;
    }

    public function close(): Computer
    {
        print "台式电脑关闭 ...\n";
        return $this;
    }
}
