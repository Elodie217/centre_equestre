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


    public function addUser($lastnameUserAdd, $firstnameUserAdd, $emailUserAdd, $phoneUserAdd, $birthdateUserAdd, $addressUserAdd, $roleUserAdd, $levelUserAdd)
    {
        $loginUserAdd = strtolower($lastnameUserAdd . '.' . $firstnameUserAdd);

        $sql = "INSERT INTO " . PREFIXE . "user (lastname_user, firstname_user, email_user, phone_user, address_user, birthdate_user, role_user, actif_user, login_user, id_level) VALUES (:lastnameUserAdd, :firstnameUserAdd, :emailUserAdd, :phoneUserAdd, :addressUserAdd, :birthdateUserAdd, :roleUserAdd, 1, :loginUserAdd, :levelUserAdd)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':lastnameUserAdd', $lastnameUserAdd);
        $statement->bindParam(':firstnameUserAdd', $firstnameUserAdd);
        $statement->bindParam(':emailUserAdd', $emailUserAdd);
        $statement->bindParam(':phoneUserAdd', $phoneUserAdd);
        $statement->bindParam(':addressUserAdd', $addressUserAdd);
        $statement->bindParam(':birthdateUserAdd', $birthdateUserAdd);
        $statement->bindParam(':roleUserAdd', $roleUserAdd);
        $statement->bindParam(':loginUserAdd', $loginUserAdd);
        $statement->bindParam(':levelUserAdd', $levelUserAdd);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Nouveau cavalier enregistré !"
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

    public function editUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit, $roleUserEdit, $levelUserEdit)
    {
        $sql = "UPDATE " . PREFIXE . "user SET lastname_user = :lastnameUserEdit, firstname_user = :firstnameUserEdit, email_user = :emailUserEdit, phone_user = :phoneUserEdit, address_user = :addressUserEdit, birthdate_user = :birthdateUserEdit, role_user = :roleUserEdit, id_level = :levelUserEdit WHERE id_user = :idUserEdit";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':lastnameUserEdit', $lastnameUserEdit);
        $statement->bindParam(':firstnameUserEdit', $firstnameUserEdit);
        $statement->bindParam(':emailUserEdit', $emailUserEdit);
        $statement->bindParam(':phoneUserEdit', $phoneUserEdit);
        $statement->bindParam(':addressUserEdit', $addressUserEdit);
        $statement->bindParam(':birthdateUserEdit', $birthdateUserEdit);
        $statement->bindParam(':roleUserEdit', $roleUserEdit);
        $statement->bindParam(':levelUserEdit', $levelUserEdit);
        $statement->bindParam(':idUserEdit', $idUserEdit);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Cavalier modifié !"
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

    public function disableUser($idUserEdit)
    {
        $sql = "UPDATE " . PREFIXE . "user SET actif_user = 0 WHERE id_user = :idUserEdit";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idUserEdit', $idUserEdit);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Compte désactivé !"
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

    public function deleteUser($idUser)
    {
        $sql = "DELETE FROM " . PREFIXE . "user_lesson WHERE id_user = :idUser;
        DELETE FROM " . PREFIXE . "horse WHERE id_user = :idUser;
        DELETE FROM " . PREFIXE . "user WHERE id_user = :idUser";


        $statement = $this->db->prepare($sql);

        $statement->bindParam(':idUser', $idUser);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Compte supprimé !"
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
