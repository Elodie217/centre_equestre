<?php

namespace src\Controllers;

use src\Repositories\HorseRepository;
use src\Repositories\LessonRepository;
use src\Repositories\LevelRepository;
use src\Services\Reponse;

class LevelController
{

    use Reponse;


    // public function horses(): void
    // {
    //     if (isset($_GET['erreur'])) {
    //         $erreur = htmlspecialchars($_GET['erreur']);
    //     } else {
    //         $erreur = '';
    //     }

    //     $this->render("horses", ["erreur" => $erreur]);
    // }

    public function allLevels()
    {
        $LevelRepository = new LevelRepository;
        $reponse = $LevelRepository->getAllLevels();
        return json_encode($reponse);
    }

    // function horseById($idHorse)
    // {
    //     $HorseRepository = new HorseRepository;
    //     $reponse = $HorseRepository->getHorsesById($idHorse);
    //     return json_encode($reponse);
    // }



    // public function addHorse($nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox)
    // {
    //     if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox)) {
    //         if (strlen($nameHorse) <= 50) {
    //             $nameHorse = htmlspecialchars($nameHorse);

    //             if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
    //                 $imageHorse = htmlspecialchars($imageHorse);

    //                 list($year, $month, $day) = explode("-", $birthdateHorse);

    //                 if (checkdate($month, $day, $year)) {
    //                     $birthdateHorse = htmlspecialchars($birthdateHorse);

    //                     if (is_int($horseUser) && is_int($horseBox)) {
    //                         $horseUser = htmlspecialchars($horseUser);
    //                         $horseBox = htmlspecialchars($horseBox);


    //                         $HorseRepository = new HorseRepository;
    //                         $reponse = $HorseRepository->addHorse($nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox);
    //                         return json_encode($reponse);
    //                     } else {
    //                         $response = array(
    //                             'status' => 'error',
    //                             'message' => 'Merci de selectionner un champ.'
    //                         );
    //                         return json_encode($response);
    //                         die;
    //                     }
    //                 } else {
    //                     $response = array(
    //                         'status' => 'error',
    //                         'message' => 'Merci de renter une date valide.'
    //                     );
    //                     return json_encode($response);
    //                     die;
    //                 }
    //             } else {
    //                 $response = array(
    //                     'status' => 'error',
    //                     'message' => 'Merci de renter un URL valide.'
    //                 );
    //                 return json_encode($response);
    //                 die;
    //             }
    //         } else {
    //             $response = array(
    //                 'status' => 'error',
    //                 'message' => 'Le nom doit faire au maximum 50 caractères.'
    //             );
    //             return json_encode($response);
    //             die;
    //         }
    //     } else {
    //         $response = array(
    //             'status' => 'error',
    //             'message' => 'Merci de remplir tous les champs.'
    //         );
    //         return json_encode($response);
    //         die;
    //     }
    // }


    // public function editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox)
    // {
    //     if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox)) {
    //         if (strlen($nameHorse) <= 50) {
    //             $nameHorse = htmlspecialchars($nameHorse);

    //             if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
    //                 $imageHorse = htmlspecialchars($imageHorse);

    //                 list($year, $month, $day) = explode("-", $birthdateHorse);

    //                 if (checkdate($month, $day, $year)) {
    //                     $birthdateHorse = htmlspecialchars($birthdateHorse);

    //                     if (is_int($horseUser) && is_int($horseBox)) {
    //                         $horseUser = htmlspecialchars($horseUser);
    //                         $horseBox = htmlspecialchars($horseBox);


    //                         $HorseRepository = new HorseRepository;
    //                         $reponse = $HorseRepository->editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox);
    //                         return json_encode($reponse);
    //                     } else {
    //                         $response = array(
    //                             'status' => 'error',
    //                             'message' => 'Merci de selectionner un champ.'
    //                         );
    //                         return json_encode($response);
    //                         die;
    //                     }
    //                 } else {
    //                     $response = array(
    //                         'status' => 'error',
    //                         'message' => 'Merci de renter une date valide.'
    //                     );
    //                     return json_encode($response);
    //                     die;
    //                 }
    //             } else {
    //                 $response = array(
    //                     'status' => 'error',
    //                     'message' => 'Merci de renter un URL valide.'
    //                 );
    //                 return json_encode($response);
    //                 die;
    //             }
    //         } else {
    //             $response = array(
    //                 'status' => 'error',
    //                 'message' => 'Le nom doit faire au maximum 50 caractères.'
    //             );
    //             return json_encode($response);
    //             die;
    //         }
    //     } else {
    //         $response = array(
    //             'status' => 'error',
    //             'message' => 'Merci de remplir tous les champs.'
    //         );
    //         return json_encode($response);
    //         die;
    //     }
    // }

    // function deleteHorse($idHorse)
    // {
    //     $HorseRepository = new HorseRepository;
    //     $reponse = $HorseRepository->deleteHorse($idHorse);
    //     return json_encode($reponse);
    // }
}
