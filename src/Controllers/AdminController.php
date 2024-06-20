<?php

namespace src\Controllers;

use src\Services\Reponse;

class AdminController
{

    use Reponse;

    public function lesson(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("lessonAdmin", ["erreur" => $erreur]);
    }

    public function horses(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("horsesAdmin", ["erreur" => $erreur]);
    }

    public function box(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("boxAdmin", ["erreur" => $erreur]);
    }

    public function user(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("userAdmin", ["erreur" => $erreur]);
    }

    public function contact(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("contactAdmin", ["erreur" => $erreur]);
    }
}
