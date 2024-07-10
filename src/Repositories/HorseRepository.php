<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Horse;

class HorseRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllHorses()
    {

        $sql = " SELECT " . PREFIXE . "horse.id_horse, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.birthdate_horse, " . PREFIXE . "horse.image_horse, " . PREFIXE . "horse.height_horse, " . PREFIXE . "horse.coat_horse, " . PREFIXE . "box.name_box, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "boarding.id_boarding, " . PREFIXE . "boarding.name_boarding
            FROM " . PREFIXE . "horse
            JOIN " . PREFIXE . "user ON " . PREFIXE . "horse.id_user = " . PREFIXE . "user.id_user
            JOIN " . PREFIXE . "box ON " . PREFIXE . "horse.id_box = " . PREFIXE . "box.id_box
            LEFT JOIN " . PREFIXE . "boarding ON " . PREFIXE . "horse.id_boarding = " . PREFIXE . "boarding.id_boarding
            ORDER BY " . PREFIXE . "horse.name_horse ASC";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Horse::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getHorsesById($idHorse)
    {

        $sql = "SELECT " . PREFIXE . "horse.id_horse, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.birthdate_horse, " . PREFIXE . "horse.image_horse, " . PREFIXE . "horse.height_horse, " . PREFIXE . "horse.coat_horse, " . PREFIXE . "box.name_box, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "boarding.id_boarding, " . PREFIXE . "boarding.name_boarding
            FROM " . PREFIXE . "horse
            JOIN " . PREFIXE . "user ON " . PREFIXE . "horse.id_user = " . PREFIXE . "user.id_user
            JOIN " . PREFIXE . "box ON " . PREFIXE . "horse.id_box = " . PREFIXE . "box.id_box
            LEFT JOIN " . PREFIXE . "boarding ON " . PREFIXE . "horse.id_boarding = " . PREFIXE . "boarding.id_boarding
            WHERE  " . PREFIXE . "horse.id_horse = :id_horse
            ORDER BY " . PREFIXE . "horse.name_horse ASC";


        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id_horse', $idHorse);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, Horse::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }

    public function addHorse($nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        $sql = "INSERT INTO " . PREFIXE . "horse (name_horse, birthdate_horse, image_horse,height_horse,coat_horse, id_user, id_box, id_boarding) VALUES (:nameHorse, :birthdateHorse, :imageHorse, :heightHorse,:coatHorse, :horseUser, :horseBox, :boardingHorse)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nameHorse', $nameHorse);
        $statement->bindParam(':imageHorse', $imageHorse);
        $statement->bindParam(':birthdateHorse', $birthdateHorse);
        $statement->bindParam(':heightHorse', $heightHorse);
        $statement->bindParam(':coatHorse', $coatHorse);
        $statement->bindParam(':horseUser', $horseUser);
        $statement->bindParam(':horseBox', $horseBox);
        $statement->bindParam(':boardingHorse', $boardingHorse);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Nouveau cheval enregistré !"
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

    public function editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        $sql = "UPDATE " . PREFIXE . "horse SET name_horse = :nameHorse, birthdate_horse = :birthdateHorse, image_horse = :imageHorse, height_horse = :heightHorse, coat_horse = :coatHorse, id_user = :horseUser, id_box = :horseBox, id_boarding = :boardingHorse WHERE id_horse = :idHorse";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idHorse', $idHorse);
        $statement->bindParam(':nameHorse', $nameHorse);
        $statement->bindParam(':imageHorse', $imageHorse);
        $statement->bindParam(':birthdateHorse', $birthdateHorse);
        $statement->bindParam(':heightHorse', $heightHorse);
        $statement->bindParam(':coatHorse', $coatHorse);
        $statement->bindParam(':horseUser', $horseUser);
        $statement->bindParam(':horseBox', $horseBox);
        $statement->bindParam(':boardingHorse', $boardingHorse);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => $nameHorse . ' a bien été modifié !'
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

    public function deleteHorse($idHorse)
    {
        $sql = "DELETE FROM " . PREFIXE . "horse WHERE id_horse = :id_horse";

        $statement = $this->db->prepare($sql);

        $statement->bindParam(':id_horse', $idHorse);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Cheval supprimé !"
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
