<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

interface HardDisk
{
    public function showSize(): HardDisk;

    public function showSpeed(): HardDisk;
}
