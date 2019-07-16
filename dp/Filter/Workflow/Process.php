<?php


namespace Trink\Dp\Filter\Workflow;

use ReflectionClass;
use ReflectionException;

abstract class Process
{
    /** @var Worker[] $workers */
    protected $workers = [];

    public function addWorker($workers): Process
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

    abstract public function exec(): Process;
}
