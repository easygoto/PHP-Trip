<?php


namespace Trink\Dp\AbstractFactory\ComputerSetting;

/**
 * @method HardDisk showSize()
 * @method HardDisk showSpeed()
 * @method HardDisk showType()
 */
abstract class HardDisk
{
    protected $size;
    protected $speed;
    protected $type;

    public function __construct()
    {
        $class_full_name = get_class($this);
        $class_name      = substr($class_full_name, strrpos($class_full_name, '\\') + 1);
        preg_match('/(HDD|SSD)(\d+[GT])(\d+RPM)?/', $class_name, $props);
        $this->type = $props[1] ?? 'NO MATCHED';
        $this->size = $props[2] ?? 0;
        if ($this->type == 'HDD') {
            $this->speed = sprintf("%d %s", (int)($props[3] ?? 0) / 100, 'M/s');
        } else {
            $this->speed = ($this->type == 'SSD') ? '450 M/s' : '0 B/s';
        }
    }

    public function __call($method_name, $arguments)
    {
        if (strpos($method_name, 'show') !== false) {
            $raw_property = substr($method_name, strlen('show'));
            $property     = lcfirst($raw_property);
            print "Hard Disk {$raw_property} : {$this->$property}\n";
            return $this;
        }
    }
}
