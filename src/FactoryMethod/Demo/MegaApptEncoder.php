<?php


namespace Trink\Dp\FactoryMethod\Demo;


class MegaApptEncoder extends ApptEncoder {
    function encode(){
        return "Appointment data encodeed in MegaCal format\n";
    }
}
