<?php

namespace Acme\DB;

use PDO;
use Dotenv\Dotenv;

abstract class Model
{
    private static $conn;

    protected static function connect()
    {
        if (!is_null(self::$conn)) {
            return self::$conn;
        }

        $dotenv = new Dotenv(__DIR__, '../../.env');
        $dotenv->load();

        $host = getenv('DB_HOST');
        $database = getenv('DB_DATABASE');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        self::$conn = new PDO($dsn, $username, $password, $opt);

        return self::$conn;
    }

    public static function query($sql)
    {
        $conn = self::connect();
        $prp = $conn->prepare($sql);
        $prp->execute();
        $prp->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $prp->fetchAll();
    }

    public static function find($sql, $params)
    {
        $conn = self::connect();
        $prp = $conn->prepare($sql);
        $prp->execute($params);
        $prp->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $prp->fetch();
    }
}
