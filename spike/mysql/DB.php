<?php
/**
 * Created by PhpStorm.
 * User: LiJian
 * Date: 2019/3/24
 * Time: 9:29
 */

namespace spike\mysql;

use PDO;

/**
 * Class DB
 *
 * @package spike\mysql
 */
class DB {

    private const HOST     = '127.0.0.1';
    private const DBNAME   = 'test';
    private const USER     = 'root';
    private const PASSWORD = '123123';

    /**
     * @var PDO
     */
    private static $db = null;

    private function __construct() { }

    /**
     * @return PDO
     */
    public static function getInstance() {
        if (self::$db == null) {
            $dsn      = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME;
            self::$db = new PDO($dsn, self::USER, self::PASSWORD);
        }
        return self::$db;
    }
}