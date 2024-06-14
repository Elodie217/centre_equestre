<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Horse;

class LessonRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    // public function getAllHorses()
    // {

    //     $sql = "SELECT " . PREFIXE . "horse.id_horse, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "horse.image_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "box.name_box, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user FROM " . PREFIXE . "horse, " . PREFIXE . "user, " . PREFIXE . "box
    //     WHERE " . PREFIXE . "horse.id_user =  " . PREFIXE . "user.id_user
    //     AND " . PREFIXE . "horse.id_box =  " . PREFIXE . "box.id_box";

    //     $statement = $this->db->prepare($sql);

    //     $statement->execute();

    //     $objets = $statement->fetchAll(PDO::FETCH_CLASS, Horse::class);
    //     $retour =  [];

    //     foreach ($objets as $objet) {
    //         array_push($retour, $objet->getObjectToArray());
    //     }
    //     return $retour;
    // }

    // public function getHorsesById($idHorse)
    // {

    //     $sql = "SELECT " . PREFIXE . "horse.id_horse, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "horse.image_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "horse.id_box," . PREFIXE . "horse.id_user," . PREFIXE . "box.name_box, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user FROM " . PREFIXE . "horse, " . PREFIXE . "user, " . PREFIXE . "box
    //     WHERE " . PREFIXE . "horse.id_user =  " . PREFIXE . "user.id_user
    //     AND " . PREFIXE . "horse.id_box =  " . PREFIXE . "box.id_box
    //     AND " . PREFIXE . "horse.id_horse = :id_horse";

    //     $statement = $this->db->prepare($sql);
    //     $statement->bindParam(':id_horse', $idHorse);

    //     $statement->execute();

    //     $statement->setFetchMode(PDO::FETCH_CLASS, Horse::class);
    //     $objet = $statement->fetch();

    //     $retour = $objet->getObjectToArray();

    //     return $retour;
    // }

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

    // public function editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox)
    // {
    //     $sql = "UPDATE " . PREFIXE . "horse SET name_horse = :nameHorse, birthdate_horse = :birthdateHorse, image_horse = :imageHorse, id_user = :horseUser, id_box = :horseBox WHERE id_horse = :idHorse";

    //     $statement = $this->db->prepare($sql);
    //     $statement->bindParam(':idHorse', $idHorse);
    //     $statement->bindParam(':nameHorse', $nameHorse);
    //     $statement->bindParam(':imageHorse', $imageHorse);
    //     $statement->bindParam(':birthdateHorse', $birthdateHorse);
    //     $statement->bindParam(':horseUser', $horseUser);
    //     $statement->bindParam(':horseBox', $horseBox);

    //     if ($statement->execute()) {
    //         $reponse = array(
    //             'status' => 'success',
    //             'message' => $nameHorse . ' a bien été modifié !'
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
