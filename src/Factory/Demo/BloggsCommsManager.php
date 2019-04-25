<?php


namespace Trink\Dp\Factory\Demo;

class BloggsCommsManager extends CommsManager
{
    public function getApptEncoder()
    {
        return new BloggsApptEncoder;
    }

    public function getHeaderText()
    {
        return "BloggsCal header\n";
    }

    public function getFooterText()
    {
        return "BloggsCal footer\n";
    }
}
