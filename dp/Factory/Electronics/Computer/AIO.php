<?php

namespace Trink\App\Dp\Factory\Electronics\Computer;

class AIO implements Operate
{
    public function run()
    {
        print "一体机启动 ...\n";
    }

    public function play()
    {
        print "能玩啥游戏啊 ...\n";
    }

    public function close()
    {
        print "一体机关闭 ...\n";
    }
}
