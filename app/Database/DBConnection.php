<?php
namespace App\Database;

class DBConnection
{
    private static ?\PDO $pdo = null;


    public static function make($config)
    {
        try {
            return self::$pdo = self::$pdo ?: new \PDO("mysql:host={$config['host']};dbname={$config['name']}", $config['user'], $config['password']);

//            return self::$pdo;
        } catch (\PDOException $e) {
            die('could not connect to Database.');
        }
    }
}