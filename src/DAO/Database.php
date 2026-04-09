<?php

namespace Projeto\ApiPets\DAO;

use \PDO;
use \Exception;

class Database {

    public static function getConnection(): PDO {
        try {

            $host = "localhost";
            $db_name = "pet_api";
            $username = "root";
            $password = "";

            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;
            
        } catch (Exception $e) {
            throw new Exception("Erro na conexão com o banco: " . $e->getMessage());
        }
    }
}