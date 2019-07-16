<?php


namespace Trink\Dp\Factory\Electronics;

interface Computer
{
    public function run(): Computer;

    public function play(): Computer;

    public function close(): Computer;
}
