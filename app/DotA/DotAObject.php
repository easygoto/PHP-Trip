<?php


namespace Trink\App\Trip\DotA;

abstract class DotAObject
{
    public function __call($methodName, $arguments)
    {
        if (strpos($methodName, 'get') === 0) {
            $variableName = lcfirst(substr($methodName, 3));
            return $this->$variableName ?? null;
        } elseif (strpos($methodName, 'set') === 0) {
            $variableName = lcfirst(substr($methodName, 3));
            list($value) = $arguments;
            if (property_exists($this, $variableName)) {
                $this->$variableName = $value;
                return $this;
            }
        }
        return null;
    }
}
