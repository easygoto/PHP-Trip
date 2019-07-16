<?php


namespace Trink\Dp\Factory\Electronics\Computer;

use Trink\Dp\Factory\Electronics\Computer;

class Tablet implements Computer
{
    public function run(): Computer
    {
        print "平板电脑启动 ...\n";
        return $this;
    }

    public function play(): Computer
    {
        print "这玩的是啥游戏啊 ...\n";
        return $this;
    }

    public function close(): Computer
    {
        print "平板电脑关闭 ...\n";
        return $this;
    }
}
