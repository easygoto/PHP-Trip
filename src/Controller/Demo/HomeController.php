<?php

namespace Trink\Frame\Controller\Demo;

use Trink\Frame\Component\BaseController;

class HomeController extends BaseController
{
    // 主页
    public function index()
    {
        require $this->renderPart();
    }

    // 微信朋友圈
    public function moments()
    {
        require $this->renderPart();
    }

    // 编辑 svg 图形
    public function svg()
    {
        require $this->renderPart();
    }
}
