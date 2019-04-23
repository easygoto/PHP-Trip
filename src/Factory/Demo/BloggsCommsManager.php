<?php


namespace Trink\Dp\Factory\Demo;


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
