<?php

namespace Bulletproof\Crud\app\config;

class Database
{

    static function getConnection() : ?\PDO{
        $host = 'localhost';
        $port = 3306;
        $database = 'shop_db';
        $username = 'root';
        $password = '';

        try {
            $connection = new \PDO("mysql:host=$host;port=$port;dbname=$database" , $username , $password);
            echo "Success connected to database" . PHP_EOL;
            return $connection;
        }catch (\PDOException $e){
            echo "Error : " . $e->getMessage();
            return null;
        }

    }

}

