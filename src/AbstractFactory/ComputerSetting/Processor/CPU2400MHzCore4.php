<?php

namespace Trink\Dp\AbstractFactory\ComputerSetting\Processor;

use Trink\Dp\AbstractFactory\ComputerSetting\Processor;

class CPU2400MHzCore4 implements Processor
{
    public function showCore(): Processor
    {
        print "CPU Core : 4\n";
        return $this;
    }

    public function showFrequency(): Processor
    {
        print "CPU Frequency : 2400MHz\n";
        return $this;
    }
}
