<?php


namespace Trink\Dp\AbstractFactory\Demo;


abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getAppEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}
