<?php


namespace Trink\Dp\Factory\Electronics;

interface Phone
{
    public function open(): Phone;

    public function call(): Phone;
}
