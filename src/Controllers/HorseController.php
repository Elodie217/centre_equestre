<?php

namespace src\Controllers;

use src\Repositories\HorseRepository;
use src\Services\Reponse;

class HorseController
{

    use Reponse;

    public function horses(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("horses", ["erreur" => $erreur]);
    }

    public function allHorses()
    {

        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->getAllHorses();
        return json_encode($reponse);
    }

    function horseById($idHorse)
    {
        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->getHorsesById($idHorse);
        return json_encode($reponse);
    }



    public function addHorse($nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox) && isset($boardingHorse) && !empty($boardingHorse)) {
            if (strlen($nameHorse) <= 50) {
                $nameHorse = htmlspecialchars($nameHorse);

                if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
                    $imageHorse = htmlspecialchars($imageHorse);

                    list($year, $month, $day) = explode("-", $birthdateHorse);

                    if (checkdate($month, $day, $year)) {
                        $birthdateHorse = htmlspecialchars($birthdateHorse);

                        if (is_int($horseUser) && is_int($horseBox) && is_int($boardingHorse)) {
                            $horseUser = htmlspecialchars($horseUser);
                            $horseBox = htmlspecialchars($horseBox);

                            if ($boardingHorse == 0) {
                                $boardingHorse = NULL;
                            } else {
                                $boardingHorse = htmlspecialchars($boardingHorse);
                            }

                            if (is_int((int)$heightHorse) && (int)$heightHorse > 0 && (int)$heightHorse < 200 || $heightHorse == '') {
                                if ($heightHorse == '') {
                                    $heightHorse = NULL;
                                } else {
                                    $heightHorse = htmlspecialchars($heightHorse);
                                }
                                if (strlen($coatHorse) <= 50) {
                                    if ($coatHorse == '') {
                                        $coatHorse = NULL;
                                    } else {
                                        $coatHorse = htmlspecialchars($coatHorse);
                                    }
                                    $HorseRepository = new HorseRepository;
                                    $reponse = $HorseRepository->addHorse($nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse);
                                    return json_encode($reponse);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'La robe doit faire au maximum 50 caractères.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Merci de rentrer une taille valide.'
                                );
                                return json_encode($response);
                                die;
                            }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'Merci de selectionner un champ.'
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
                        'message' => 'Merci de renter un URL valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom doit faire au maximum 50 caractères.'
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


    public function editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox) && isset($boardingHorse) && !empty($boardingHorse)) {
            if (strlen($nameHorse) <= 50) {
                $nameHorse = htmlspecialchars($nameHorse);

                if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
                    $imageHorse = htmlspecialchars($imageHorse);

                    list($year, $month, $day) = explode("-", $birthdateHorse);

                    if (checkdate($month, $day, $year)) {
                        $birthdateHorse = htmlspecialchars($birthdateHorse);

                        if (is_int($horseUser) && is_int($horseBox) && is_int($boardingHorse)) {
                            $horseUser = htmlspecialchars($horseUser);
                            $horseBox = htmlspecialchars($horseBox);

                            if ($boardingHorse == 0) {
                                $boardingHorse = NULL;
                            } else {
                                $boardingHorse = htmlspecialchars($boardingHorse);
                            }

                            if (is_int((int)$heightHorse) && (int)$heightHorse > 0 && (int)$heightHorse < 200 || $heightHorse == '') {
                                if ($heightHorse == '') {
                                    $heightHorse = NULL;
                                } else {
                                    $heightHorse = htmlspecialchars($heightHorse);
                                }
                                if (strlen($coatHorse) <= 50) {
                                    if ($coatHorse == '') {
                                        $coatHorse = NULL;
                                    } else {
                                        $coatHorse = htmlspecialchars($coatHorse);
                                    }
                                    $HorseRepository = new HorseRepository;
                                    $reponse = $HorseRepository->editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse);

                                    return json_encode($reponse);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'La robe doit faire au maximum 50 caractères.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Merci de rentrer une taille valide.'
                                );
                                return json_encode($response);
                                die;
                            }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'Merci de selectionner un champ.'
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
                        'message' => 'Merci de renter un URL valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom doit faire au maximum 50 caractères.'
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

    function deleteHorse($idHorse)
    {
        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->deleteHorse($idHorse);
        return json_encode($reponse);
    }
}
