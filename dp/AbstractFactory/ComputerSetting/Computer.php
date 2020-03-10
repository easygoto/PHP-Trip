<?php

namespace Trink\App\Dp\AbstractFactory\ComputerSetting;

abstract class Computer
{
    /** @var HardDisk[] $hardDisk */
    protected $hardDisk;

    /** @var Memory[] $memory */
    protected $memory;

    /** @var CPU $cpu */
    protected $cpu;

    public function setHardDisk(array $hardDisk): Computer
    {
        $this->hardDisk = $hardDisk;
        return $this;
    }

    public function setMemory(array $memory): Computer
    {
        $this->memory = $memory;
        return $this;
    }

    public function setCpu(CPU $cpu): Computer
    {
        $this->cpu = $cpu;
        return $this;
    }

    public static function instance()
    {
        return new static;
    }

    public function info(): Computer
    {
        foreach ($this->hardDisk as $hardDisk) {
            $hardDisk->showType()->showSize()->showSpeed();
        }
        foreach ($this->memory as $memory) {
            $memory->showSize();
        }
        $this->cpu->showCore()->showFrequency();
        return $this;
    }
}
