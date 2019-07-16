<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

/**
 * @method HardDisk showSize()
 */
abstract class Memory
{
    protected $size;

    public function __construct()
    {
        $class_full_name = get_class($this);
        $class_name      = substr($class_full_name, strrpos($class_full_name, '\\') + 1);
        preg_match('/Memory(\d+[GT])/', $class_name, $props);
        $this->size = $props[1] ?? 0;
    }

    public function __call($method_name, $arguments)
    {
        if (strpos($method_name, 'show') !== false) {
            $raw_property = substr($method_name, strlen('show'));
            $property     = lcfirst($raw_property);
            print "Memory {$raw_property} : {$this->$property}\n";
            return $this;
        }
    }
}
