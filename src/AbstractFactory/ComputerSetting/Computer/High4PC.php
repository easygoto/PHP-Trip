<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Computer;

use Trink\Dp\AbstractFactory\ComputerSetting\Computer;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\SSD2T;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory\Memory8G;
use Trink\Dp\AbstractFactory\ComputerSetting\Processor;
use Trink\Dp\AbstractFactory\ComputerSetting\Processor\CPU4000MHzCore8;

class High4PC implements Computer
{
    public function hardDisk(): HardDisk
    {
        return new SSD2T();
    }

    public function memory(): array
    {
        return [
            new Memory8G(),
            new Memory8G(),
            new Memory8G(),
            new Memory8G(),
        ];
    }

    public function cpu(): Processor
    {
        return new CPU4000MHzCore8();
    }
}
