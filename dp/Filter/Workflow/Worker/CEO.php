<?php


namespace Trink\Dp\Filter\Workflow\Worker;

use Trink\Dp\Filter\Workflow\Worker;

class CEO implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 7) {
            print "CEO handle leave ...\n";
        }
    }
}
