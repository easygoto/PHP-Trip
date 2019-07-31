<?php


namespace Trink\Core\Container\Statement;

interface Config
{
    public function get(string $key);

    public function set(string $key);
}
