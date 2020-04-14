<?php

namespace Trink\App\Trip\Distribute;

class Consistent implements Hashes, Distribution
{
    protected array $servers = [];

    protected array $points = [];

    protected int $mulNum = 64;

    public function getPoints()
    {
        return $this->points;
    }

    public function lookup($key)
    {
        $position = $this->hash($key);
        reset($this->points);
        $needle = key($this->points);
        foreach ($this->points as $pKey => $item) {
            if ($position <= $pKey) {
                $needle = $pKey;
                break;
            }
        }
        return $this->points[$needle];
    }

    public function hash($str)
    {
        return sprintf('%u', crc32($str));
    }

    public function addServer($ser)
    {
        $this->servers[$ser] = [];

        for ($i = 0; $i < $this->mulNum; $i++) {
            $point = $this->hash($ser . '_' . $i);
            $this->points[$point] = $ser;

            $this->servers[$ser][] = $point;
            $this->resort();
        }
    }

    protected function resort()
    {
        ksort($this->points);
    }

    public function delServer($ser)
    {
        foreach ($this->servers[$ser] as $value) {
            unset($this->points[$value]);
        }
        unset($this->servers[$ser]);
    }
}
