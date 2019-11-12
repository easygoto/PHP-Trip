<?php


namespace Trink\App\Dp\Interpreter\Demo;

abstract class Expression
{
    private static $keyCount = 0;
    private $key;

    abstract public function interpret(InterpreterContext $context);

    public function getKey()
    {
        if (!isset($this->key)) {
            self::$keyCount++;
            $this->key = self::$keyCount;
        }
        return $this->key;
    }
}
