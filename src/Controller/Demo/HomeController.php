<?php

namespace Trink\Frame\Controller\Demo;

use Trink\Frame\Component\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        require $this->renderPart();
    }

    public function coolClock()
    {
        require $this->renderPart();
    }

    public function lovelyFish()
    {
        require $this->renderPart();
    }

    public function moments()
    {
        require $this->renderPart();
    }
}
