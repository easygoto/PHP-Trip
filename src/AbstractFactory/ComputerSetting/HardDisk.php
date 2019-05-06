<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

abstract class HardDisk
{
    protected $size;
    protected $speed;

    public function __call($name, $arguments)
    {
        $this->size = 1;
        $this->speed = 3;
        call_user_func_array([__CLASS__, $name], $arguments);
    }

    abstract public function showSize(): HardDisk;

    abstract public function showSpeed(): HardDisk;
}
