<?php


namespace Trink\Dp\Filter\Workflow\Worker;

use Trink\Dp\Filter\Workflow\Worker;

class Director implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 3) {
            print "Director handle leave ...\n";
        }
    }
}
