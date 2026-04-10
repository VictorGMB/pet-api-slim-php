<?php

namespace Projeto\ApiPets\DAO;

use \PDO;
use \Exception;

class Database {

    public static function getConnection(): PDO {
        try {

            $dbName = getenv('DB_NAME') ?: 'pet_api';
            $host = getenv('DB_HOST') ?: 'localhost';
            $username = getenv('DB_USER') ?: 'root';
            $password = getenv('DB_PASS') ?: '';

            $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;
            
        } catch (Exception $e) {
            throw new Exception("Erro na conexão com o banco: " . $e->getMessage());
        }
    }
}