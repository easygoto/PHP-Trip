<?php


namespace Trink\Dp\Filter\Workflow;

use ReflectionClass;
use ReflectionException;

class Leave
{
    /** @var int $days */
    private $days;

    /** @var Worker[] $workers */
    private $workers = [];

    public function getDays(): int
    {
        return $this->days;
    }

    public function setDays(int $days): Leave
    {
        $this->days = $days;
        return $this;
    }

    public function addWorker($workers): Leave
    {
        if (is_array($workers)) {
            $this->workers = array_merge($this->workers, array_map(function ($worker) {
                return (new ReflectionClass($worker))->newInstance();
            }, $workers));
        } elseif (is_string($workers)) {
            try {
                $this->workers[] = (new ReflectionClass($workers))->newInstance();
            } catch (ReflectionException $e) {
            }
        }
        return $this;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function exec(): Leave
    {
        foreach ($this->workers as $worker) {
            $worker->handleLeave($this->days);
        }
        return $this;
    }
}
