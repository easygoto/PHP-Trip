<?php


namespace Trink\Dp\Filter\Workflow\Worker;

use Trink\Dp\Filter\Workflow\Worker;

class Manager implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 5) {
            print "Manager handle leave ...\n";
        }
    }
}
