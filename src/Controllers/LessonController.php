<?php

namespace src\Controllers;

use src\Repositories\HorseRepository;
use src\Repositories\LessonRepository;
use src\Services\Reponse;

class LessonController
{

    use Reponse;

    //User

    public function allLessonsByIdUser($idUser)
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->getAllLessonsByIdUser($idUser);
        return json_encode($reponse);
    }

    public function allLessonsByIdLevelUser()
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->getAllLessonsByIdLevelUser();
        return json_encode($reponse);
    }

    public function changeLessonUser($idNewLesson, $idOldLesson)
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->changeLessonUser($idNewLesson, $idOldLesson);
        return json_encode($reponse);
    }

    public   function deleteLessonUser($idLesson)
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->deleteLessonUser($idLesson);
        return json_encode($reponse);
    }

    //Admin

    public function allLessons()
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->getAllLessons();
        return json_encode($reponse);
    }


    public function addLesson($titleLessonAdd, $dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd)
    {
        if (isset($titleLessonAdd) && !empty($titleLessonAdd) && isset($dateLessonAdd) && !empty($dateLessonAdd) && isset($hourLessonAdd) && !empty($hourLessonAdd) && isset($placeLessonAdd) && !empty($placeLessonAdd)) {
            if (
                strlen($titleLessonAdd) <= 50
            ) {
                $titleLessonAdd = htmlspecialchars($titleLessonAdd);

                list($year, $month, $day) = explode("-", $dateLessonAdd);

                if (checkdate($month, $day, $year)) {
                    $dateLessonAdd = htmlspecialchars($dateLessonAdd);

                    if (is_int($placeLessonAdd)) {
                        $placeLessonAdd = htmlspecialchars($placeLessonAdd);

                        list($hour, $minute) = explode(":", $hourLessonAdd);

                        if ($hour >= 0 && $hour <= 24 && $minute >= 0 && $minute <= 60) {
                            $LessonRepository = new LessonRepository;
                            $reponse = $LessonRepository->addLesson($titleLessonAdd, $dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd);
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
                    'message' => 'Le titre doit faire au maximum 50 caractères.'
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


    public function editLesson($idLessonEdit, $titleLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit)
    {
        if (isset($dateLessonEdit) && !empty($dateLessonEdit) && isset($hourLessonEdit) && !empty($hourLessonEdit) && isset($placeLessonEdit) && !empty($placeLessonEdit)) {
            if (
                strlen($titleLessonEdit) <= 50
            ) {
                $titleLessonEdit = htmlspecialchars($titleLessonEdit);
                list($year, $month, $day) = explode("-", $dateLessonEdit);

                if (checkdate($month, $day, $year)) {
                    $dateLessonEdit = htmlspecialchars($dateLessonEdit);

                    if (is_int($placeLessonEdit)) {
                        $placeLessonEdit = htmlspecialchars($placeLessonEdit);

                        list($hour, $minute) = explode(":", $hourLessonEdit);

                        if ($hour >= 0 && $hour <= 24 && $minute >= 0 && $minute <= 60) {
                            $LessonRepository = new LessonRepository;
                            $reponse = $LessonRepository->editLesson($idLessonEdit, $titleLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit);
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
                    'message' => 'Le titre doit faire au maximum 50 caractères.'
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


    function deleteLesson($idLesson)
    {
        $LessonRepository = new LessonRepository;
        $reponse = $LessonRepository->deleteLesson($idLesson);
        return json_encode($reponse);
    }
}
