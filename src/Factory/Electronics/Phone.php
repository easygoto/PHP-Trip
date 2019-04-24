<?php


namespace Trink\Dp\Factory\Electronics;


interface Phone {

    function open(): Phone;

    function call(): Phone;
}