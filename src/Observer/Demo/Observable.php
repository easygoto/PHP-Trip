<?php


namespace Trink\Dp\Observer\Demo;

interface Observable
{
    public function attach(Observer $observer);

    public function detach(Observer $observer);

    public function notify();

    public function getStatus();
}
