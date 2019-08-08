<?php


namespace Trink\Dp\Factory\Electronics\Computer;

class PC implements Operate
{
    public function run()
    {
        print "台式电脑启动 ...\n";
    }

    public function play()
    {
        print "啥游戏都能玩 ...\n";
    }

    public function close()
    {
        print "台式电脑关闭 ...\n";
    }
}
