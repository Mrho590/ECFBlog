<?php
// src/Database.php

namespace Mrho\Config;

class Database {
    public static function connect() {
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assurez-vous d'utiliser le bon mot de passe
        $dbname = "ecf";
        $port = 3306;

        try {
            $conn = new \PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            // Définir le mode d'erreur PDO à exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(\PDOException $e) {
            echo "Erreur de connexion: " . $e->getMessage();
            return null;
        }
    }
}
