<?php


namespace Trink\Dp\DependencyInjection\Company;

use Trink\Dp\DependencyInjection\Company\Worker\CustomerService;
use Trink\Dp\DependencyInjection\Company\Worker\Sales;
use Trink\Dp\DependencyInjection\Company\Worker\Technology;

/**
 * Class Dream
 *
 * @package Trink\Dp\DependencyInjection\Container
 *
 * @property Sales           sales
 * @property Technology      technology
 * @property CustomerService customerService
 */
class Dream
{
    protected static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'sales':
                return new Sales($this->technology);
                break;
            case 'technology':
                return new Technology;
                break;
            case 'customerService':
                return new CustomerService($this->technology);
                break;
            default:
        }
        return null;
    }
}
