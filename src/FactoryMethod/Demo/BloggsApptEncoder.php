<?php


namespace Trink\FactoryMethod\Demo;


class BloggsApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in BloggsCal format\n";
    }
}
