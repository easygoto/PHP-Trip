<?php

namespace Trink\Core\Component;

interface Setting
{
    public function get(string $key = null);

    public function set(string $key, $value);

    public function initDefault();
}
