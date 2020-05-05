<?php

namespace Trink\Frame\Controller\Demo;

use Trink\Frame\Component\BaseController;

class CanvasController extends BaseController
{
    // 炫酷时钟
    public function coolClock()
    {
        require $this->renderPart();
    }

    // 喂鱼小游戏
    public function lovelyFish()
    {
        require $this->renderPart();
    }

    // 小球跟随鼠标的移动效果
    public function ballMove()
    {
        require $this->renderPart();
    }

    // 数学函数
    public function mathLove()
    {
        require $this->renderPart();
    }
}
