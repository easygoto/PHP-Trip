<?php


namespace Trink\FactoryMethod\Demo;


abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getFooterText();
}
