<?php

namespace Trink\App\Dp\Factory\Demo;

abstract class CommsManager
{
    abstract public function getHeaderText();

    abstract public function getApptEncoder();

    abstract public function getFooterText();
}
