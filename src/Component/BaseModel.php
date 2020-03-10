<?php

namespace Trink\Frame\Component;

use ReflectionObject;

abstract class BaseModel
{
    protected array $attributes;

    public function getAttributes()
    {
        $model = new ReflectionObject($this);
        $properties = $model->getProperties();
        $propertyNameList = array_column($properties, 'name');
        $data = [];
        foreach ($propertyNameList as $property) {
            if ($this->$property === null) {
                continue;
            }
            $data[$property] = $this->$property;
        }
        return $data;
    }
}
