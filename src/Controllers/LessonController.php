<?php

namespace src\Controllers;

use src\Repositories\HorseRepository;
use src\Repositories\LessonRepository;
use src\Services\Reponse;

class LessonController
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

    public function allLessons()
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->getAllLessons();
        return json_encode($reponse);
    }

    // function horseById($idHorse)
    // {
    //     $HorseRepository = new HorseRepository;
    //     $reponse = $HorseRepository->getHorsesById($idHorse);
    //     return json_encode($reponse);
    // }



    public function addLesson($dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd)
    {
        if (isset($dateLessonAdd) && !empty($dateLessonAdd) && isset($hourLessonAdd) && !empty($hourLessonAdd) && isset($placeLessonAdd) && !empty($placeLessonAdd)) {

            list($year, $month, $day) = explode("-", $dateLessonAdd);

            if (checkdate($month, $day, $year)) {
                $dateLessonAdd = htmlspecialchars($dateLessonAdd);

                if (is_int($placeLessonAdd)) {
                    $placeLessonAdd = htmlspecialchars($placeLessonAdd);

                    list($hour, $minute) = explode(":", $hourLessonAdd);

                    if ($hour >= 0 && $hour <= 24 && $minute >= 0 && $minute <= 60) {
                        $LessonRepository = new LessonRepository;
                        $reponse = $LessonRepository->addLesson($dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd);
                        return json_encode($reponse);
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => "Merci de rentrer une heure valide."
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => "Merci de rentrer un nombre de place plus grand que 0."
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de renter une date valide.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }


    public function editLesson($idLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit)
    {
        if (isset($dateLessonEdit) && !empty($dateLessonEdit) && isset($hourLessonEdit) && !empty($hourLessonEdit) && isset($placeLessonEdit) && !empty($placeLessonEdit)) {

            list($year, $month, $day) = explode("-", $dateLessonEdit);

            if (checkdate($month, $day, $year)) {
                $dateLessonEdit = htmlspecialchars($dateLessonEdit);

                if (is_int($placeLessonEdit)) {
                    $placeLessonEdit = htmlspecialchars($placeLessonEdit);

                    list($hour, $minute) = explode(":", $hourLessonEdit);

                    if ($hour >= 0 && $hour <= 24 && $minute >= 0 && $minute <= 60) {
                        $LessonRepository = new LessonRepository;
                        $reponse = $LessonRepository->editLesson($idLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit);
                        return json_encode($reponse);
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => "Merci de rentrer une heure valide."
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => "Merci de rentrer un nombre supérieur à 0."
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de renter une date valide.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }
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

    function deleteLesson($idLesson)
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->deleteLesson($idLesson);
        return json_encode($reponse);
    }
}
