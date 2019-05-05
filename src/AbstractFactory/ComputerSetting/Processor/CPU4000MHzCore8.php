<?php

namespace Trink\Dp\AbstractFactory\ComputerSetting\Processor;

use Trink\Dp\AbstractFactory\ComputerSetting\Processor;

class CPU4000MHzCore8 implements Processor
{
    public function showCore(): Processor
    {
        print "CPU Core : 8\n";
        return $this;
    }

    public function showFrequency(): Processor
    {
        print "CPU Frequency : 4000MHz\n";
        return $this;
    }
}
