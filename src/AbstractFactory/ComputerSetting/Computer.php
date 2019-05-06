<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

interface Computer
{
    public function hardDisk(): HardDisk;

    public function memory(): array;

    public function cpu(): CPU;
}
