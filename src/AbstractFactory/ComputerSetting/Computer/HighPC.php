<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting\Computer;

use Trink\Dp\AbstractFactory\ComputerSetting\Computer;
use Trink\Dp\AbstractFactory\ComputerSetting\CPU\CPU4000MHzCore8;
use Trink\Dp\AbstractFactory\ComputerSetting\HardDisk\SSD2T;
use Trink\Dp\AbstractFactory\ComputerSetting\Memory\Memory8G;

class HighPC extends Computer
{
    public function __construct()
    {
        $this->hardDisk = [
            new SSD2T,
        ];
        $this->memory = [
            new Memory8G,
            new Memory8G,
            new Memory8G,
            new Memory8G,
        ];
        $this->cpu = new CPU4000MHzCore8;
    }
}
