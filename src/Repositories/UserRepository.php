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
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.email_user, " . PREFIXE . "user.phone_user, " . PREFIXE . "user.role_user, " . PREFIXE . "level.name_level FROM " . PREFIXE . "user
        LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "user.id_level = " . PREFIXE . "level.id_level";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getUserById($idUser)
    {

        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.email_user, " . PREFIXE . "user.phone_user, " . PREFIXE . "user.address_user, " . PREFIXE . "user.birthdate_user, " . PREFIXE . "user.role_user, " . PREFIXE . "user.actif_user, " . PREFIXE . "user.gdpr_user, " . PREFIXE . "user.login_user, " . PREFIXE . "user.id_level, " . PREFIXE . "level.name_level FROM " . PREFIXE . "user
        LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "user.id_level = " . PREFIXE . "level.id_level
	    WHERE " . PREFIXE . "user.id_user = :idUser";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idUser', $idUser);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

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
