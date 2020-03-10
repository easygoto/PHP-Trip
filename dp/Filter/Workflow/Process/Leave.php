<?php

namespace Trink\App\Dp\Filter\Workflow\Process;

use Trink\App\Dp\Filter\Workflow\Process;

class Leave extends Process
{
    /** @var int $days */
    private $days;

    public function getDays(): int
    {
        return $this->days;
    }

    public function setDays(int $days): Process
    {
        $this->days = $days;
        return $this;
    }

    public function exec(): Process
    {
        foreach ($this->workers as $worker) {
            $worker->handleLeave($this->days);
        }
        return $this;
    }
}
