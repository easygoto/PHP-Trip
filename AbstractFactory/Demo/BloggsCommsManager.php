<?php


namespace AbstractFactory\Demo;


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
