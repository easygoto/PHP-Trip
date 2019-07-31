<?php


namespace Trink\Core\Component\Config;

use Trink\Core\Container\Statement\Config;
use Trink\Core\Helper\Arrays;

/**
 * @method array db(array $keyMap)
 */
class Index implements Config
{
    private $props;

    /** @var Arrays $arrays */
    protected $arrays;

    public function __construct(array $opts = [])
    {
        $this->arrays = $opts['arrays'];
        $this->props  = require_once TRIP_ROOT . '/config/config.php';
    }

    public function __call($name, $arguments)
    {
        list($keyMap) = $arguments;
        $props    = $this->props[$name];
        $newProps = [];
        foreach ($keyMap as $key => $configKey) {
            $newProps[$key] = $props[$configKey];
        }
        return $newProps;
    }

    public function get(string $key)
    {
        return $this->arrays::get($this->props, $key);
    }

    public function set(string $key)
    {
    }
}
