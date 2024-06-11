<?php

namespace src\Controllers;

use src\Services\Reponse;

class HorseController
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

    public function addhorse($nameHorse, $imageHorse, $breedHorse, $horseUser, $horseBox)
    {

        if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($breedHorse) && !empty($breedHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox)) {

            $nameHorse = htmlspecialchars($nameHorse);
            $imageHorse = htmlspecialchars($imageHorse);
            $breedHorse = htmlspecialchars($breedHorse);
            $placePromo = htmlspecialchars($horseUser);
            $placePromo = htmlspecialchars($horseBox);



            $PromoRepository = new PromoRepository;
            $reponse = $PromoRepository->sauvegarderPromo($nameHorse, $imageHorse, $breedHorse, $horseUser, $horseBox);
            return json_encode($reponse);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }
}
