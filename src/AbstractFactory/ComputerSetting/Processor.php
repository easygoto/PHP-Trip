<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

interface Processor
{
    public function showCore(): Processor;

    public function showFrequency(): Processor;
}
