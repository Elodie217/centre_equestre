<?php

namespace src\Repositories;

use PDO;
use src\Models\Contact;
use src\Models\Database;

class ContactRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function sendContact($lastnameContact, $firstnameContact, $emailContact, $messageContact)
    {
        $dateContact = date("Y-m-d H:i:s");

        $sql = "INSERT INTO " . PREFIXE . "contact (lastname_contact, firstname_contact, email_contact, message_contact, date_contact, id_status) VALUES (:lastnameContact, :firstnameContact, :emailContact, :messageContact, :dateContact, 1)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':lastnameContact', $lastnameContact);
        $statement->bindParam(':firstnameContact', $firstnameContact);
        $statement->bindParam(':emailContact', $emailContact);
        $statement->bindParam(':messageContact', $messageContact);
        $statement->bindParam(':dateContact', $dateContact);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Votre message à bien été envoyé !"
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


    public function getAllContact()
    {

        $sql = "SELECT * FROM " . PREFIXE . "contact";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Contact::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getContactById($idContact)
    {
        $sql = "SELECT * FROM " . PREFIXE . "contact
                WHERE " . PREFIXE . "contact.id_contact = :idContact";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idContact', $idContact);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, Contact::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }


    public function changeStatus($idStatus, $idContact)
    {
        $sql = "UPDATE " . PREFIXE . "contact SET id_status = :idStatus WHERE id_contact = :idContact";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idStatus', $idStatus);
        $statement->bindParam(':idContact', $idContact);

        if ($statement->execute()) {

            $reponse = array(
                'status' => 'success',
                'message' => 'Statut modifié !'
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


    public function deleteContact($idContact)
    {
        $sql = "DELETE FROM " . PREFIXE . "contact WHERE id_contact = :idContact";


        $statement = $this->db->prepare($sql);

        $statement->bindParam(':idContact', $idContact);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Message supprimé !"
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
