<?php

namespace src\Models;

use PDO;
use PDOException;

final class Database
{
    private $DB;
    private $config;

    public function __construct()
    {
        $this->config = __DIR__ . '/../../config.php';
        require_once $this->config;

        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->DB = new PDO($dsn, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $error) {
            echo "Erreur de connexion à la Base de Données : " . $error->getMessage();
        }
    }

    /**
     * Retourne la connexion BDD établie et l'objet PDO associé.
     */
    public function getDB(): PDO
    {
        return $this->DB;
    }
}
