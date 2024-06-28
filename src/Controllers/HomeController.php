<?php

namespace src\Controllers;

use src\Repositories\UserRepository;
use src\Services\Reponse;

class HomeController
{

    use Reponse;

    public function index(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("accueil", ["erreur" => $erreur]);
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

    public function logout()
    {
        session_destroy();
        return 'success';
    }
}
