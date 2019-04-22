<?php


namespace Trink\Dp\Composite\Demo;


abstract class Unit {
    function getComposite(){
        return null;
    }

    abstract function bombardStrength();
}
