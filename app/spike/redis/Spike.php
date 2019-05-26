<?php

namespace spike\redis;

use Redis;

/**
 * Class Spike
 *
 * @package spike\redis
 */
class Spike {

    /**
     * @var Redis
     */
    private $_db = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }
}