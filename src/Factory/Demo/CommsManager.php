<?php


namespace Trink\Dp\Factory\Demo;


abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getFooterText();
}
