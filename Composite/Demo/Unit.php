<?php


namespace Trink\Composite\Demo;


abstract class Unit {
    function getComposite(){
        return null;
    }

    abstract function bombardStrength();
}
