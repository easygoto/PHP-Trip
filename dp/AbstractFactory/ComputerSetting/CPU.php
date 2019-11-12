<?php


namespace Trink\App\Dp\AbstractFactory\ComputerSetting;

/**
 * @method CPU showCore()
 * @method CPU showFrequency()
 */
abstract class CPU
{
    protected $core;
    protected $frequency;

    public function __construct()
    {
        $class_full_name = get_class($this);
        $class_name      = substr($class_full_name, strrpos($class_full_name, '\\') + 1);
        preg_match('/CPU(?<frequency>\d+[MG]Hz)Core(?<core>\d+)/', $class_name, $props);
        $this->frequency = $props['frequency'] ?? '0 Hz';
        $this->core      = $props['core'] ?? 0;
    }

    public function __call($method_name, $arguments)
    {
        if (strpos($method_name, 'show') !== false) {
            $raw_property = substr($method_name, strlen('show'));
            $property     = lcfirst($raw_property);
            print "CPU {$raw_property} : {$this->$property}\n";
            return $this;
        }
    }
}
