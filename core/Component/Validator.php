<?php

namespace Trink\Core\Component;

/**
 * 仿 Yii2 验证器
 * Class Validate
 *
 * @package Trink\Core\Component
 */
class Validator
{
    protected static $instance;

    protected function __construct()
    {
    }

    public static function instance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
