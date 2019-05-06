<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Computer;

use Trink\Dp\AbstractFactory\ComputerSetting\Computer;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\HDD1T5400RPM;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory\Memory2G;
use Trink\Dp\AbstractFactory\ComputerSetting\Processor;
use Trink\Dp\AbstractFactory\ComputerSetting\Processor\CPU2400MHzCore4;

class Low4PC implements Computer
{
    public function hardDisk(): HardDisk
    {
        return new HDD1T5400RPM();
    }

    public function memory(): array
    {
        return [
            new Memory2G(),
            new Memory2G(),
        ];
    }

    public function cpu(): Processor
    {
        return new CPU2400MHzCore4();
    }
}
