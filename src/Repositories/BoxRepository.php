<?php

namespace src\Repositories;

use PDO;
use src\Models\Box;
use src\Models\Database;

class BoxRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllBox()
    {

        $sql = "SELECT * FROM " . PREFIXE . "box";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Box::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getAllBoxHorse()
    {

        $sql = "SELECT " . PREFIXE . "box.id_box, " . PREFIXE . "box.name_box, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.id_horse 
            FROM " . PREFIXE . "box 
            LEFT JOIN " . PREFIXE . "horse ON " . PREFIXE . "box.id_box = " . PREFIXE . "horse.id_box 
            ORDER BY " . PREFIXE . "box.name_box;";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Box::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }


    public function addBox($nameBox)
    {
        $sql = "INSERT INTO " . PREFIXE . "box (name_box) VALUES (:nameBox)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nameBox', $nameBox);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Nouveau box enregistré !"
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

    public function editBox($idBox, $boxEdit)
    {
        // , $boxHorseEdit
        $sql = "UPDATE " . PREFIXE . "box SET name_box = :boxEdit WHERE id_box = :idBox";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idBox', $idBox);
        $statement->bindParam(':boxEdit', $boxEdit);

        if ($statement->execute()) {
            // if ($boxHorseEdit == 0) {
            //     $reponse = array(
            //         'status' => 'success',
            //         'message' => $boxEdit . 'a bien été modifié !'
            //     );
            //     return $reponse;
            // } else {
            //     $sql = "UPDATE " . PREFIXE . "horse SET id_box = :idBox WHERE id_horse = :boxHorseEdit";

            //     $statement = $this->db->prepare($sql);
            //     $statement->bindParam(':idBox', $idBox);
            //     $statement->bindParam(':boxHorseEdit', $boxHorseEdit);


            //     if ($statement->execute()) {
            //         $reponse = array(
            //             'status' => 'success',
            //             'message' => $boxEdit . ' a bien été modifié !'
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
            $reponse = array(
                'status' => 'success',
                'message' => $boxEdit . ' a bien été modifié !'
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


    public function deleteBox($idBox)
    {
        $sql = "SELECT " . PREFIXE . "horse.id_horse  FROM " . PREFIXE . "horse 
                WHERE " . PREFIXE . "horse.id_box = :idBox ";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idBox', $idBox);
        $statement->execute();

        $idHorses = $statement->fetchAll(PDO::FETCH_DEFAULT);

        foreach ($idHorses as $idHorse) {
            $idHorse = $idHorse['id_horse'];

            $sql = "UPDATE " . PREFIXE . "horse SET id_box = 2 WHERE id_horse = :idHorse";

            $statement = $this->db->prepare($sql);
            $statement->bindParam(':idHorse', $idHorse);
            $statement->execute();
        }


        $sql = "DELETE FROM " . PREFIXE . "box WHERE id_box = :id_box";


        $statement = $this->db->prepare($sql);

        $statement->bindParam(':id_box', $idBox);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Box supprimé !"
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
