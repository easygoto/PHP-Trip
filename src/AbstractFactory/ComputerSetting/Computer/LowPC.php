<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Computer;

use Trink\Dp\AbstractFactory\ComputerSetting\Computer;
use Trink\Dp\AbstractFactory\ComputerSetting\CPU\CPU2400MHzCore4;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\HDD1T5400RPM;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory\Memory2G;

class LowPC extends Computer
{
    public function __construct()
    {
        $this->hardDisk = [
            new HDD1T5400RPM,
        ];
        $this->memory = [
            new Memory2G,
            new Memory2G,
        ];
        $this->cpu = new CPU2400MHzCore4;
    }
}
