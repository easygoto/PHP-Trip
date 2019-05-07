<?php


namespace Trink\Dp\Filter\Workflow;

class Leader implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 1) {
            print "Leader handle leave ...\n";
        }
    }
}
