<?php
namespace App\Infrastructure\Database;

use PDO;

class Connection {

    public static function make(): PDO
    {
        $config = require __DIR__ . '/../../../config/database.php';

        return new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']}",
            $config['username'],
            $config['password']
        );
    }
}