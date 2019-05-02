<?php

namespace spike\mysql;

use PDO;

/**
 * Class DB
 *
 * @package spike\mysql
 */
class DB {

    private const HOST     = '127.0.0.1';
    private const PORT     = '3306';
    private const DBNAME   = 'test';
    private const USER     = 'root';
    private const PASSWORD = '123123';

    /**
     * @var PDO
     */
    private static $_db = null;

    private function __construct() { }

    /**
     * @return PDO
     */
    public static function getInstance() {
        if (self::$_db == null) {
            $dsn       = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME . ';port=' . self::PORT;
            self::$_db = new PDO($dsn, self::USER, self::PASSWORD);
        }
        return self::$_db;
    }
}