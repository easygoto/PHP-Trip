<?php

namespace Trink\App\Dp\Factory\Electronics\Computer;

class Laptop implements Operate
{
    public function run()
    {
        print "笔记本电脑启动 ...\n";
    }

    public function play()
    {
        print "玩个啥游戏好 ...\n";
    }

    public function close()
    {
        print "笔记本电脑关闭 ...\n";
    }
}
