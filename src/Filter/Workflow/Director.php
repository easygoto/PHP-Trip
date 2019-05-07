<?php


namespace Trink\Dp\Filter\Workflow;

class Director implements Worker
{
    public function handleLeave(int $day = 0)
    {
        if ($day >= 3) {
            print "Director handle leave ...\n";
        }
    }
}
