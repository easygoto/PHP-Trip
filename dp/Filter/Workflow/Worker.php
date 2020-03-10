<?php

namespace Trink\App\Dp\Filter\Workflow;

interface Worker
{
    public function handleLeave(int $day = 0);
}
