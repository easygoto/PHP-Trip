<?php


namespace Trink\App\Dp\Filter\Workflow\Worker;

use Trink\App\Dp\Filter\Workflow\Worker;

class CEO implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 7) {
            print "CEO handle leave ...\n";
        }
    }
}
