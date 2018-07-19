<?php

abstract class ApptEncoder {
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in BloggsCal format\n";
    }
}

class MegaApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in MegaCal format\n";
    }
}

abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {
    function getApptEncoder(){
        return new BloggsApptEncoder;
    }

    function getHeaderText(){
        return "BloggsCal header\n";
    }

    function getFooterText(){
        return "BloggsCal footer\n";
    }
}

$bcm = new BloggsCommsManager();
echo $bcm->getHeaderText();
var_dump($bcm->getApptEncoder());
echo $bcm->getFooterText();