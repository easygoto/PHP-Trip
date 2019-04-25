<?php


namespace Trink\Dp\Factory\Electronics\Computer;

use Trink\Dp\Factory\Electronics\Computer;

class AIO implements Computer
{
    public function run(): Computer
    {
        print "一体机启动 ...\n";
        return $this;
    }

    public function play(): Computer
    {
        print "能玩啥游戏啊 ...\n";
        return $this;
    }

    public function close(): Computer
    {
        print "一体机关闭 ...\n";
        return $this;
    }
}
