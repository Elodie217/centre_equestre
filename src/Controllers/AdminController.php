<?php

namespace src\Controllers;

use src\Services\Reponse;

class AdminController
{

    use Reponse;

    // public function index(): void
    // {
    //     if (isset($_GET['erreur'])) {
    //         $erreur = htmlspecialchars($_GET['erreur']);
    //     } else {
    //         $erreur = '';
    //     }

    //     $this->render("accueil", ["erreur" => $erreur]);
    // }

    public function horses(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("horses", ["erreur" => $erreur]);
    }
}
