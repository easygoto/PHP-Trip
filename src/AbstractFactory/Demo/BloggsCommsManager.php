<?php


namespace Trink\Dp\AbstractFactory\Demo;

class BloggsCommsManager extends CommsManager
{
    public function getHeaderText()
    {
        return "BloggsCal header\n";
    }

    public function getAppEncoder()
    {
        return new BloggsApptEncoder;
    }

    public function getTtdEncoder()
    {
        return new BloggsTtdEncoder;
    }

    public function getContactEncoder()
    {
        return new BloggsContactEncoder;
    }

    public function getFooterText()
    {
        return "BloggsCal footer\n";
    }
}
