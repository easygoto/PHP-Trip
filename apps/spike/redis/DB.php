<?php

namespace spike\redis;

use Redis;

/**
 * Class DB
 *
 * @package spike\redis
 */
class DB {

    private const HOST = '127.0.0.1';
    private const PORT = '6379';

    /**
     * @var Redis
     */
    private static $_db;

    private function __construct() { }

    /**
     * @return Redis
     */
    public static function getInstance() {
        if (self::$_db == null) {
            self::$_db = new Redis();
        }
        self::$_db->connect(self::HOST, self::PORT);
        return self::$_db;
    }

    public function close() {
        self::$_db->close();
    }
}