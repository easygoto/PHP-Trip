<?php


namespace Trink\Dp\Factory\Electronics\Computer;

class Tablet implements Operate
{
    public function run()
    {
        print "平板电脑启动 ...\n";
    }

    public function play()
    {
        print "这玩的是啥游戏啊 ...\n";
    }

    public function close()
    {
        print "平板电脑关闭 ...\n";
    }
}
