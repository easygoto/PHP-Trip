<?php


namespace Trink\Dp\Factory\Electronics;


interface Computer {

    function run(): Computer;

    function play(): Computer;

    function close(): Computer;
}