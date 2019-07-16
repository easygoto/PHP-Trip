<?php


namespace Trink\Dp\Filter\Workflow\Worker;

use Trink\Dp\Filter\Workflow\Worker;

class Leader implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 1) {
            print "Leader handle leave ...\n";
        }
    }
}
