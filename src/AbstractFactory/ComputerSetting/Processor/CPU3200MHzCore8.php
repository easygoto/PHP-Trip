<?php

namespace Trink\Dp\AbstractFactory\ComputerSetting\Processor;

use Trink\Dp\AbstractFactory\ComputerSetting\Processor;

class CPU3200MHzCore8 implements Processor
{
    public function showCore(): Processor
    {
        print "CPU Core : 8\n";
        return $this;
    }

    public function showFrequency(): Processor
    {
        print "CPU Frequency : 3200MHz\n";
        return $this;
    }
}
