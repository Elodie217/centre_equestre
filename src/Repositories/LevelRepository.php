<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Level;

class LevelRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllLevels()
    {

        $sql = "SELECT " . PREFIXE . "level.id_level, " . PREFIXE . "level.name_level FROM " . PREFIXE . "level";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Level::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function addLevel($nameLevel)
    {
        $sql = "INSERT INTO " . PREFIXE . "level (name_level) VALUES (:nameLevel)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nameLevel', $nameLevel);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Nouveau niveau enregistré !"
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }


    public function deleteLevel($idLevel)
    {
        $sql = "UPDATE " . PREFIXE . "user SET id_level = null WHERE id_level = :id_Level;
        DELETE FROM " . PREFIXE . "lesson_level WHERE id_level = :id_Level;
        DELETE FROM " . PREFIXE . "level WHERE id_level = :id_Level";

        $statement = $this->db->prepare($sql);

        $statement->bindParam(':id_Level', $idLevel);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Niveau supprimé !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }
}
