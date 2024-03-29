<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 01.03.17
 * Time: 10:58
 */

namespace comm\app\core;

use PDO as PDO;

class DB
{
    private static $_instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Подключение к бд через патерн Singleton
     * @return bool|null|PDO
     */
    public static function connect()
    {
        if (is_null(self::$_instance)) {
            $dns = 'mysql:host=' . HOST . '; dbname=' . DB_NAME . '; charset=utf8;';
            $db_option = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
            ];
            try {
                self::$_instance = new PDO($dns, DB_USER, DB_PASSWORD, $db_option);

            } catch (\PDOException $e) {
                echo 'Connection to database ' . DB_NAME . ' failed: ' . $e->getMessage();

                return false;
            }

            return self::$_instance;
        } else {

            return self::$_instance;
        }
    }

}