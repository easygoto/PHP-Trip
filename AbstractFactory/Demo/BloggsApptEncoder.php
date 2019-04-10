<?php


namespace AbstractFactory\Demo;


class BloggsApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in BloggsCal format\n";
    }
}
