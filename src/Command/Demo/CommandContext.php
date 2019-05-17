<?php


namespace Trink\Dp\Command\Demo;

class CommandContext
{
    private $params = [];
    private $error  = '';

    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    public function addParam($key, $val): CommandContext
    {
        $this->params[$key] = $val;
        return $this;
    }

    public function get($key)
    {
        return $this->params[$key];
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): CommandContext
    {
        $this->error = $error;
        return $this;
    }
}
