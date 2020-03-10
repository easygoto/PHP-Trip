<?php

namespace Trink\App\Dp\AbstractFactory\Demo;

abstract class CommsManager
{
    abstract public function getHeaderText();

    abstract public function getAppEncoder();

    abstract public function getTtdEncoder();

    abstract public function getContactEncoder();

    abstract public function getFooterText();
}
