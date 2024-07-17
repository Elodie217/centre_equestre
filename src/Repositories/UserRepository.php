<?php

namespace src\Repositories;

// session_start();

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

    public function loginUser($login, $passwordLogin)
    {
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.password_user, " . PREFIXE . "user.role_user, " . PREFIXE . "user.id_level, COUNT(" . PREFIXE . "horse.id_horse) AS number_horse 
            FROM " . PREFIXE . "user
            LEFT JOIN " . PREFIXE . "horse ON " . PREFIXE . "horse.id_user = " . PREFIXE . "user. id_user
            WHERE login_user =  :login";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':login', $login);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $statement->fetch();

        if ($user) {
            if (password_verify($passwordLogin, $user->getPasswordUser())) {
                $_SESSION['user'] = $user;


                $reponse = array(
                    'status' => 'success',
                    'message' => "Connected",
                    'role' => $user->getRoleUser()
                );
                return $reponse;
            } else {
                $reponse = array(
                    'status' => 'error',
                    'message' => "Identifiant ou mot de passe incorrect"
                );
                return $reponse;
            }
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Identifiant ou mot de passe incorrect"
            );
            return $reponse;
        }
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

    public function userLoginVerification($idNewUser, $loginUser)
    {
        $sql = "SELECT EXISTS( SELECT * FROM " . PREFIXE . "user WHERE id_user = :idNewUser AND login_user = :loginUser) AS " . PREFIXE . "user;";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idNewUser', $idNewUser);
        $statement->bindParam(':loginUser', $loginUser);
        $statement->execute();
        $res = $statement->fetch();
        if ($res[PREFIXE . 'user'] == 1) {
            $reponse = array(
                'status' => 'success',
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Identifiant incorrect"
            );
            return $reponse;
        }
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

    public function registration($idUser, $loginUser, $lastnameUserRegister, $firstnameUserRegister, $emailUserRegister, $phoneUserRegister, $birthdateUserRegister, $addressUserRegister, $passwordRegister)
    {
        $hashedPassword = password_hash($passwordRegister, PASSWORD_BCRYPT);

        $dateGDPR = date("Y-m-d H:i:s");

        $sql = "UPDATE " . PREFIXE . "user SET lastname_user = :lastnameUserRegister, firstname_user = :firstnameUserRegister, email_user = :emailUserRegister, phone_user = :phoneUserRegister, address_user = :addressUserRegister, birthdate_user = :birthdateUserRegister, password_user = :passwordRegister, gdpr_user = :gdprUser WHERE id_user = :idUser AND login_user = :loginUser";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':lastnameUserRegister', $lastnameUserRegister);
        $statement->bindParam(':firstnameUserRegister', $firstnameUserRegister);
        $statement->bindParam(':emailUserRegister', $emailUserRegister);
        $statement->bindParam(':phoneUserRegister', $phoneUserRegister);
        $statement->bindParam(':addressUserRegister', $addressUserRegister);
        $statement->bindParam(':birthdateUserRegister', $birthdateUserRegister);
        $statement->bindParam(':passwordRegister', $hashedPassword);
        $statement->bindParam(':gdprUser', $dateGDPR);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':loginUser', $loginUser);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Votre compte à bien été enregistré !"
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

    public function sendEmailForgetPassword($emailForgetPassword)
    {
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.email_user
            FROM " . PREFIXE . "user
	        WHERE " . PREFIXE . "user.email_user = :emailUser";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':emailUser', $emailForgetPassword);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $statement->fetch();

        if ($user) {
            return $this->emailForgetPassword($user->getEmailUser(), $user->getIdUser());
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Email incorrect"
            );
            return $reponse;
        }
    }

    public function emailForgetPassword($email, $idUser)
    {
        $to      = $email;
        $subject = 'Réinitialisation de votre mot de passe';
        $message = '<html>
        Bonjour ! <br>
        <br>  
        Vous avez demandé à réinitialiser votre mot de passe. Pour compléter cette procédure, veuillez cliquer sur le lien ci-dessous : <a href="http://centreequestre2' . HOME_URL . 'forgotPassword/' . $idUser . '">Réinitialiser mon mot de passe</a>.
        <br>
        <br>
        Si vous n\'êtes pas à l\'origine de cette demande, merci d\'ignorer ce mail.
        <br><br>
        A bientôt au centre équestre !
        </html>';

        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'From: centreequestre@gmail.com' . "\r\n" .
            'Reply-To: centreequestre@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $test = mail($to, $subject, $message, $headers);

        if ($test) {
            $reponse = array(
                'status' => 'success',
                'message' => "L'email a été envoyé ! Veuillez vérifier votre boîte de réception."
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue dans l'envoi de votre mail."
            );
        }
    }

    public function change($idUser, $loginUser, $passwordForgotPasswordUser)
    {
        $hashedPassword = password_hash($passwordForgotPasswordUser, PASSWORD_BCRYPT);

        $sql = "UPDATE " . PREFIXE . "user SET password_user = :passwordRegister WHERE id_user = :idUser AND login_user = :loginUser";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':passwordRegister', $hashedPassword);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':loginUser', $loginUser);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Votre compte à bien été enregistré !"
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
            $lastInsertedId = $this->db->lastInsertId();

            if ($this->emailRegister($emailUserAdd, $lastnameUserAdd, $firstnameUserAdd, $lastInsertedId, $loginUserAdd)) {
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
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }

    public function emailRegister($email, $lastname, $firstname, $idUser, $loginUser)
    {
        $to      = $email;
        $subject = 'Création de votre compte';
        $message = '<html>
        Bonjour ' . $lastname . ' ' . $firstname . ' ! <br>
        <br>
        Afin de créer votre espace personnel, vous pouvez dès à présent cliquer sur <a href="http://centreequestre2' . HOME_URL . 'register/' . $idUser . '">ce lien</a> pour créer votre mot de passe.
        <br>
        <br>
        Voici votre identifiant à utiliser pour lors de votre connexion : ' . $loginUser . '
        <br><br>
        A bientôt au centre équestre !
        </html>';

        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'From: centreequestre@gmail.com' . "\r\n" .
            'Reply-To: centreequestre@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $test = mail($to, $subject, $message, $headers);

        if ($test) {
            return true;
        } else {
            var_dump($test);
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



    public function editProfileUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit)
    {
        $sql = "UPDATE " . PREFIXE . "user SET lastname_user = :lastnameUserEdit, firstname_user = :firstnameUserEdit, email_user = :emailUserEdit, phone_user = :phoneUserEdit, address_user = :addressUserEdit, birthdate_user = :birthdateUserEdit WHERE id_user = :idUserEdit";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':lastnameUserEdit', $lastnameUserEdit);
        $statement->bindParam(':firstnameUserEdit', $firstnameUserEdit);
        $statement->bindParam(':emailUserEdit', $emailUserEdit);
        $statement->bindParam(':phoneUserEdit', $phoneUserEdit);
        $statement->bindParam(':addressUserEdit', $addressUserEdit);
        $statement->bindParam(':birthdateUserEdit', $birthdateUserEdit);
        $statement->bindParam(':idUserEdit', $idUserEdit);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Modification effectuée !"
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
