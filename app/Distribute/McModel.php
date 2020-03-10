<?php

namespace Trink\App\Trip\Distribute;

class McModel implements Hashes, Distribution
{
    protected array $servers = [];

    public function hash($str)
    {
        return sprintf('%u', crc32($str));
    }

    public function lookup($key)
    {
        $index = $this->hash($key) % count($this->servers);
        return $this->servers[$index];
    }

    public function addServer($ser)
    {
        $this->servers[] = $ser;
    }

    public function delServer($ser)
    {
        foreach ($this->servers as $key => $value) {
            if ($value == $ser) {
                unset($this->servers[$key]);
            }
        }
        $this->servers = array_merge($this->servers);
    }
}
