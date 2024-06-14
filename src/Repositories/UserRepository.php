<?php

namespace src\Repositories;

use PDO;
use src\Models\User;
use src\Models\Database;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllUser()
    {

        $sql = "SELECT * FROM " . PREFIXE . "user";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }


    // public function addHorse($nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox)
    // {
    //     $sql = "INSERT INTO " . PREFIXE . "horse (name_horse, birthdate_horse, image_horse, id_user, id_box) VALUES (:nameHorse, :birthdateHorse, :imageHorse, :horseUser, :horseBox)";

    //     $statement = $this->db->prepare($sql);
    //     $statement->bindParam(':nameHorse', $nameHorse);
    //     $statement->bindParam(':imageHorse', $imageHorse);
    //     $statement->bindParam(':birthdateHorse', $birthdateHorse);
    //     $statement->bindParam(':horseUser', $horseUser);
    //     $statement->bindParam(':horseBox', $horseBox);

    //     if ($statement->execute()) {
    //         $reponse = array(
    //             'status' => 'success',
    //             'message' => "Nouveau cheval enregistré !"
    //         );
    //         return $reponse;
    //     } else {
    //         $reponse = array(
    //             'status' => 'error',
    //             'message' => "Une erreur est survenue."
    //         );
    //         return $reponse;
    //     }
    // }


    // public function deleteHorse($idHorse)
    // {
    //     $sql = "DELETE FROM " . PREFIXE . "horse WHERE id_horse = :id_horse";


    //     $statement = $this->db->prepare($sql);

    //     $statement->bindParam(':id_horse', $idHorse);

    //     if ($statement->execute()) {
    //         $reponse = array(
    //             'status' => 'success',
    //             'message' => "Cheval supprimé !"
    //         );
    //     } else {
    //         $reponse = array(
    //             'status' => 'error',
    //             'message' => "Une erreur est survenue."
    //         );
    //     }
    //     return $reponse;
    // }
}
