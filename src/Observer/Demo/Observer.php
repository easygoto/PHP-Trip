<?php


namespace Trink\Dp\Observer\Demo;

interface Observer
{
    public function update(Observable $observable);
}
