<?php


namespace Trink\Dp\Factory\Electronics\Computer;


use Trink\Dp\Factory\Electronics\Computer;

class Laptop implements Computer {

    function run(): Computer {
        print "笔记本电脑启动 ...\n";
        return $this;
    }

    function play(): Computer {
        print "玩个啥游戏好 ...\n";
        return $this;
    }

    function close(): Computer {
        print "笔记本电脑关闭 ...\n";
        return $this;
    }
}
