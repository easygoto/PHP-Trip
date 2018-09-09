<?php

abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getAppEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}

abstract class ApptEncoder {
    abstract function encode();
}

abstract class TtdEncoder {
    abstract function encode();
}

abstract class ContactEncoder {
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in BloggsCal format\n";
    }
}

class BloggsTtdEncoder extends TtdEncoder {
    function encode(){
        return "Ttd data encodeed in BloggsCal format\n";
    }
}

class BloggsContactEncoder extends ContactEncoder {
    function encode(){
        return "Contact data encodeed in BloggsCal format\n";
    }
}

class BloggsCommsManager extends CommsManager {
    function getHeaderText(){
        return "BloggsCal header\n";
    }

    function getAppEncoder(){
        return new BloggsApptEncoder;
    }

    function getTtdEncoder(){
        return new BloggsTtdEncoder;
    }

    function getContactEncoder(){
        return new BloggsContactEncoder;
    }

    function getFooterText(){
        return "BloggsCal footer\n";
    }
}