<?php


namespace Trink\Dp\Factory\Electronics;


use Trink\Dp\Factory\Electronics\Computer\AIO;
use Trink\Dp\Factory\Electronics\Computer\Laptop;
use Trink\Dp\Factory\Electronics\Computer\PC;
use Trink\Dp\Factory\Electronics\Computer\Tablet;

class ElectronicsFactory {

    public static function createComputer($type = 'PC'): Computer {
        $type = strtolower($type);
        switch ($type) {
            default:
            case 'pc':
                return new PC();
                break;
            case 'aio':
                return new AIO();
                break;
            case 'laptop':
                return new Laptop();
                break;
            case 'tablet':
                return new Tablet();
                break;
        }
    }
}