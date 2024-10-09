<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Boarding;
use src\Models\Horse;

class BoardingRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllBoarding()
    {

        $sql = "SELECT * FROM " . PREFIXE . "boarding";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Boarding::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getBoardingById($idBoarding)
    {
        $sql = "SELECT * FROM " . PREFIXE . "boarding
        WHERE " . PREFIXE . "boarding.id_boarding = :id_boarding";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id_boarding', $idBoarding);

        $statement->execute();


        $statement->setFetchMode(PDO::FETCH_CLASS, Boarding::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }

    public function getBoardingHorse($idBoarding)
    {
        $sql = "SELECT " . PREFIXE . "horse.name_horse, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user FROM " . PREFIXE . "horse, " . PREFIXE . "user
        WHERE " . PREFIXE . "horse.id_user =  " . PREFIXE . "user.id_user
        AND " . PREFIXE . "horse.id_boarding = :id_boarding";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id_boarding', $idBoarding);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Horse::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function editBoarding($idBoarding, $nameBoardingEdit, $priceBoardingEdit, $serviceBoardingEdit, $serviceBisBoardingEdit)
    {
        $sql = "UPDATE " . PREFIXE . "boarding SET name_boarding = :nameBoardingEdit, price_boarding = :priceBoardingEdit, service_boarding = :serviceBoardingEdit, service2_boarding = :serviceBisBoardingEdit WHERE id_boarding = :idBoarding";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idBoarding', $idBoarding);
        $statement->bindParam(':nameBoardingEdit', $nameBoardingEdit);
        $statement->bindParam(':priceBoardingEdit', $priceBoardingEdit);
        $statement->bindParam(':serviceBoardingEdit', $serviceBoardingEdit);
        $statement->bindParam(':serviceBisBoardingEdit', $serviceBisBoardingEdit);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => 'La pension a bien été modifiée !'
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
}
