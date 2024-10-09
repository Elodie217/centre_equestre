<?php

namespace src\Repositories;

use src\Services\JWTService;
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
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.password_user, " . PREFIXE . "user.role_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.id_level, COUNT(" . PREFIXE . "horse.id_horse) AS number_horse 
            FROM " . PREFIXE . "user
            LEFT JOIN " . PREFIXE . "horse ON " . PREFIXE . "horse.id_user = " . PREFIXE . "user. id_user
            WHERE login_user =  :login";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':login', $login);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $statement->fetch();

        if ($user->getIdUser() !== null) {
            if (password_verify($passwordLogin, $user->getPasswordUser())) {

                $_SESSION['user'] = $user;

                $JWT = new JWTService;
                $creatJWT = $JWT->encodeToken();

                $reponse = array(
                    'status' => 'success',
                    'message' => "Connected",
                    'role' => $user->getRoleUser(),
                    'JWT' => $creatJWT
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


    public function getAllUser($name = "lastname_user", $order = "firstname_user")
    {
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.lastname_user, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.email_user, " . PREFIXE . "user.phone_user, " . PREFIXE . "user.role_user, " . PREFIXE . "user.actif_user, " . PREFIXE . "level.name_level 
        FROM " . PREFIXE . "user
        LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "user.id_level = " . PREFIXE . "level.id_level
        ORDER BY $name $order";

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

        $sql = "UPDATE " . PREFIXE . "user SET lastname_user = :lastnameUserRegister, firstname_user = :firstnameUserRegister, email_user = :emailUserRegister, phone_user = :phoneUserRegister, address_user = :addressUserRegister, birthdate_user = :birthdateUserRegister, password_user = :passwordRegister, actif_user = 1, gdpr_user = :gdprUser WHERE id_user = :idUser AND login_user = :loginUser";

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

    public function sendEmailForgetPassword($loginForgetPassword, $emailForgetPassword)
    {
        $sql = "SELECT " . PREFIXE . "user.id_user, " . PREFIXE . "user.email_user
            FROM " . PREFIXE . "user
	        WHERE " . PREFIXE . "user.login_user = :loginUser
            AND " . PREFIXE . "user.email_user = :emailUser";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':loginUser', $loginForgetPassword);
        $statement->bindParam(':emailUser', $emailForgetPassword);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $statement->fetch();

        if ($user) {
            return $this->emailForgetPassword($user->getEmailUser(), $user->getIdUser());
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Email ou identifiant incorrect"
            );
            return $reponse;
        }
    }

    public function emailForgetPassword($email, $idUser)
    {

        $to = $email;

        $subject = '=?UTF-8?B?' . base64_encode('Réinitialisation de votre mot de passe') . '?=';

        $message = '
    <html>
    <head>
        <title>Réinitialisation de votre mot de passe</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <style>
            .email-container {
                font-family: "Poppins", sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
                color: #333333;
            }
            .title {
            font-family: "Amatic SC", sans-serif;
            font-size: 45px;
            margin: 0;

            }
            .header {
                background-color: #64832F;
                padding: 10px;
                text-align: center;
                color: white;
            }
            .content {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
            }
            .button {
                background-color: #A16C21;
                color: white !important;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none !important;
                display: inline-block;
                font-size: 16px;
                margin: 20px 0;
                border-radius: 5px;
            }
            .button:hover{
                background-color: #895B1E;
                color: white !important;
                text-decoration: none !important;
            }
            .footer {
                margin-top: 20px;
                margin-bottom: 10px;
                font-size: 12px;
                text-align: center;
                color: #999999;
            }
            .logo {
                width: 100px;
                margin: 10px 0;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <img src="http://centreequestre2/public/assets/images/logo.png" alt="Logo Les cavaliers des vallées" class="logo">
                <h1 class="title">Les cavaliers des vallées</h1>
            </div>

            <div class="content">
                <p>Bonjour,</p>
                <p>Vous avez demandé à réinitialiser votre mot de passe. Pour compléter cette procédure, veuillez cliquer sur le bouton ci-dessous :</p>
                <a href="http://centreequestre2' . htmlentities(HOME_URL) . 'forgotPassword/' . htmlentities($idUser) . '" class="button">Réinitialiser mon mot de passe</a>
                <p>Si vous n\'êtes pas à l\'origine de cette demande, merci d\'ignorer ce mail.</p>
                <p>A bientôt aux Cavaliers des vallées !</p>
            </div>

            <div class="footer">
                <p>Vous recevez cet e-mail car vous êtes membre des cavaliers des vallées.</p>
                <p>Les cavaliers des vallées - 123 Rue du Cheval, 75000 Paris</p>
            </div>
        </div>
    </body>
    </html>
    ';

        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'From: centreequestre@gmail.com' . "\r\n" .
            'Reply-To: centreequestre@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $test = mail($to, $subject, $message, $headers);


        if ($test) {
            $reponse = array(
                'status' => 'success',
                'message' => "L'e-mail a été envoyé ! Veuillez vérifier votre boîte de réception."
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue dans l'envoi de votre mail."
            );
            return $reponse;
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

        // vérification si le login existe déja
        $i = 0;
        do {
            $i += 1;

            if ($i !== 1) {
                $loginUserAdd = strtolower($lastnameUserAdd . '.' . $firstnameUserAdd . $i);
            }

            $sql = "SELECT EXISTS( SELECT * FROM " . PREFIXE . "user WHERE login_user=:loginUserAdd ) AS login_exists;";
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':loginUserAdd', $loginUserAdd);
            $statement->execute();
            $res = $statement->fetch();
        } while ($res['login_exists'] !== 0);


        // enregistrement du user
        $sql = "INSERT INTO " . PREFIXE . "user (lastname_user, firstname_user, email_user, phone_user, address_user, birthdate_user, role_user, actif_user, login_user, id_level) VALUES (:lastnameUserAdd, :firstnameUserAdd, :emailUserAdd, :phoneUserAdd, :addressUserAdd, :birthdateUserAdd, :roleUserAdd, 0, :loginUserAdd, :levelUserAdd)";

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
                    'message' => "Une erreur est survenue lors de l'envoie de l'e-mail."
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

        $to = $email;
        $subject = '=?UTF-8?B?' . base64_encode('Création de compte') . '?=';

        $message = '
        <html>
            <head>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
                <title>Créer votre espace personnel</title>
                <style>
                    .email-container {
                        font-family: "Poppins", sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                        color: #333333;
                    }
                    .title {
                    font-family: "Amatic SC", sans-serif;
                    font-size: 45px;
                    margin: 0;

                    }
                    .header {
                        background-color: #64832F;
                        padding: 10px;
                        text-align: center;
                        color: white;
                    }
                    .content {
                        background-color: white;
                        padding: 20px;
                        border-radius: 10px;
                    }
                    .button {
                        background-color: #A16C21;
                        color: white !important;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none !important;
                        display: inline-block;
                        font-size: 16px;
                        margin: 20px 0;
                        border-radius: 5px;
                    }
                    .button:hover{
                        background-color: #895B1E;
                        color: white !important;
                        text-decoration: none !important;
                    }
                    .footer {
                        margin-top: 20px;
                        margin-bottom: 10px;
                        font-size: 12px;
                        text-align: center;
                        color: #999999;
                    }
                    .logo {
                        width: 100px;
                        margin: 10px 0;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                
                    <div class="header">
                        <img src="http://centreequestre2/public/assets/images/logo.png" alt="Logo Les cavaliers des vallées" class="logo">
                        <h1 class="title">Les cavaliers des vallées</h1>
                    </div>

                    <div class="content">
                        <p>Bonjour ' . htmlspecialchars($lastname) . ' ' . htmlspecialchars($firstname) . ',</p>
                        <p>Afin de créer votre espace personnel, vous pouvez dès à présent cliquer sur le bouton ci-dessous pour définir votre mot de passe :</p>
                        <a href="http://centreequestre2' . htmlentities(HOME_URL) . 'register/' . htmlentities($idUser) . '" class="button">Créer mon mot de passe</a>
                        <p>Voici votre identifiant pour vous connecter : <strong>' . htmlspecialchars($loginUser) . '</strong></p>
                        <p>Si vous avez des questions, n\'hésitez pas à nous contacter.</p>
                        <p>A bientôt aux cavaliers des vallées !</p>
                    </div>

                    <div class="footer">
                        <p>Vous recevez cet e-mail car vous êtes membre des cavaliers des vallées.</p>
                        <p>Les cavaliers des vallées - 123 Rue du Cheval, 75000 Paris</p>
                    </div>
                </div>
            </body>
        </html>';


        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'From: centreequestre@gmail.com' . "\r\n" .
            'Reply-To: centreequestre@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        try {
            // le @ permet de ne pas afficher l'erreur PHP
            $mail = @mail($to, $subject, $message, $headers);

            if ($mail) {
                return true;
            } else {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
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
