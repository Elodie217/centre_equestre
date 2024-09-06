<?php

namespace src\Controllers;

use src\Repositories\UserRepository;
use src\Services\Reponse;

class HomeController
{

    use Reponse;

    public function home(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("home", ["erreur" => $erreur]);
    }

    public function register($idNewUser): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("register", ["erreur" => $erreur, "idNewUser" => $idNewUser]);
    }

    public function emailingForgetPassword(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("emailingForgetPassword", ["erreur" => $erreur]);
    }

    public function forgotPassword($idUser): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("forgotPassword", ["erreur" => $erreur, "idUser" => $idUser]);
    }

    public function lesson(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("lesson", ["erreur" => $erreur]);
    }

    public function facility(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("facility", ["erreur" => $erreur]);
    }

    public function horses(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("horse", ["erreur" => $erreur]);
    }

    public function board(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("board", ["erreur" => $erreur]);
    }

    public function contact(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("contact", ["erreur" => $erreur]);
    }

    public function login(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("login", ["erreur" => $erreur]);
    }


    public function LoginConnection($login, $passwordLogin)
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->LoginUser($login, $passwordLogin);
        return json_encode($reponse);
    }

    public function photos(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("photos", ["erreur" => $erreur]);
    }

    public function lessonUser(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("lessonUser", ["erreur" => $erreur]);
    }

    public function horsesUser(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("horsesUser", ["erreur" => $erreur]);
    }

    public function profileUser(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("profileUser", ["erreur" => $erreur]);
    }

    public function logout()
    {
        session_destroy();
        return 'success';
    }
}
