<?php

namespace Trink\Frame\Component\Cache;

use Memcache;
use Trink\App\Dp\DependencyInjection\Demo\Concrete\DB;
use Trink\Frame\Component\Setting;

/**
 * Class McCache
 *
 * @package Trink\Frame\Component\Cache
 */
class McCache
{
    /** @var Memcache */
    protected $mc;

    protected $setting = [];

    /** @var McCache */
    protected static $instance;

    public function mc()
    {
        return $this->mc;
    }

    protected function __construct()
    {
    }

    public function __destruct()
    {
        if ($this->mc) {
            $this->mc->close();
        }
    }

    public static function instance(Setting $setting, ?DB $db)
    {
        if (!static::$instance instanceof static) {
            static::$instance = new static();
        }

        if (!static::$instance->setting) {
            static::$instance->setting = $setting->get('mc');
        }

        if (!static::$instance->mc) {
            $mc = new Memcache();
            $mcs = static::$instance->setting;
            $mc->pconnect($mcs['host'], $mcs['port']);
            static::$instance->mc = $mc;
        }

        return static::$instance;
    }

    private function generateKey($name, $key)
    {
        $prefix = $this->setting['prefix'] ?? '';
        return "{$prefix}_{$name}::{$key}";
    }

    private function getData($name, $key)
    {
        $key = $this->generateKey($name, $key);
        $result = $this->mc->get($key);
        if ($result === false) {
            $result = rand(1e8, 1e9 - 1);
            $this->mc->set($key, $result);
        }
        return $result;
    }

    private function rmData($name, $key)
    {
        $key = $this->generateKey($name, $key);
        return $this->mc->delete($key);
    }

    public function __call($name, $arguments)
    {
        preg_match('/(?<type>get|rm)(?<dataName>.*)/', $name, $matches);
        [$id] = $arguments;
        ['type' => $type, 'dataName' => $dataName] = $matches;
        if (!$id || !$dataName) {
            return null;
        }
        switch ($type) {
            case 'get':
                return $this->getData($dataName, $id);
            case 'rm':
                return $this->rmData($dataName, $id);
            default:
                return null;
        }
    }
}
