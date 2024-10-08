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

    public function horseById($idHorse)
    {
        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->getHorsesById($idHorse);
        return json_encode($reponse);
    }

    public function byIdUser()
    {
        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->getHorsesbyIdUser();
        return json_encode($reponse);
    }

    public function addHorse($nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        // var_dump($imageHorse);
        if (isset($nameHorse) && !empty($nameHorse) && isset($imageHorse) && !empty($imageHorse) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox) && isset($boardingHorse)) {
            if (strlen($nameHorse) <= 50) {
                $nameHorse = htmlspecialchars($nameHorse);

                if (in_array($imageHorse['type'], ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'])) {
                    $max_upload = 2 * 1024 * 1024;
                    if ($imageHorse['size'] <= $max_upload) {


                        list($year, $month, $day) = explode("-", $birthdateHorse);

                        if (checkdate($month, $day, $year) && strtotime($birthdateHorse) < time()) {
                            $birthdateHorse = htmlspecialchars($birthdateHorse);

                            if ($horseUser > 0 && $horseBox > 0 && $boardingHorse >= 0) {
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

                                        $extension = strtolower(pathinfo($imageHorse['name'], PATHINFO_EXTENSION));

                                        $folder = __DIR__ . "/../../public/assets/images/horses/";

                                        $nameImage = $nameHorse;

                                        $i = 0;
                                        while (file_exists($folder . $nameImage . '.' . $extension)) {
                                            $i++;
                                            $nameImage = $nameHorse . $i;
                                        }

                                        move_uploaded_file($imageHorse['tmp_name'], $folder . $nameImage . '.' . $extension);


                                        $linkImage = "/public/assets/images/horses/" . $nameImage . '.' . $extension;

                                        $HorseRepository = new HorseRepository;

                                        $reponse = $HorseRepository->addHorse($nameHorse, $linkImage, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse);
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
                            'message' => "L'image de doit pas dépasser 2Mo."
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => "Les formats d'image accepté sont : png, jpeg, jpg et svg"
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


    public function editHorse($idHorse, $nameImageHorse, $nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse)
    {
        if (is_array($imageHorse)) {
            if (in_array($imageHorse['type'], ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'])) {
                $max_upload = 2 * 1024 * 1024;
                if ($imageHorse['size'] <= $max_upload) {

                    $folder = __DIR__ . "/../../public/assets/images/horses/";

                    $imageFile = $folder . $nameImageHorse;

                    if (file_exists($imageFile)) {
                        unlink($imageFile);
                    }

                    $extension = strtolower(pathinfo($imageHorse['name'], PATHINFO_EXTENSION));


                    $nameImage = $nameHorse;

                    $i = 0;
                    while (file_exists($folder . $nameImage . '.' . $extension)) {
                        $i++;
                        $nameImage = $nameHorse . $i;
                    }

                    move_uploaded_file($imageHorse['tmp_name'], $folder . $nameImage . '.' . $extension);

                    $linkImage = "/public/assets/images/horses/" . $nameImage . '.' . $extension;
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => "L'image de doit pas dépasser 2Mo."
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => "Les formats d'image accepté sont : png, jpeg, jpg et svg"
                );
                return json_encode($response);
                die;
            }
        } else if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
            $linkImage = "/public/assets/images/horses/" . $nameImageHorse;
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de mettre une photo.'
            );
            return json_encode($response);
            die;
        }

        if (isset($nameHorse) && !empty($nameHorse) && isset($linkImage) && !empty($linkImage) && isset($birthdateHorse) && !empty($birthdateHorse) && isset($horseUser) && !empty($horseUser) && isset($horseBox) && !empty($horseBox) && isset($boardingHorse)) {
            if (strlen($nameHorse) <= 50) {
                $nameHorse = htmlspecialchars($nameHorse);

                list($year, $month, $day) = explode("-", $birthdateHorse);

                if (checkdate($month, $day, $year) && strtotime($birthdateHorse) < time()) {
                    $birthdateHorse = htmlspecialchars($birthdateHorse);

                    if ($horseUser > 0 && $horseBox > 0 && $boardingHorse >= 0) {
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
                                $reponse = $HorseRepository->editHorse($idHorse, $nameHorse, $linkImage, $birthdateHorse, $heightHorse, $coatHorse, $horseUser, $horseBox, $boardingHorse);

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

    public function editHorseUser($idHorse, $nameImageHorse, $nameHorse, $imageHorse, $birthdateHorse, $heightHorse, $coatHorse)
    {

        if (is_array($imageHorse)) {
            if (in_array($imageHorse['type'], ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'])) {
                $max_upload = 2 * 1024 * 1024;
                if ($imageHorse['size'] <= $max_upload) {

                    $folder = __DIR__ . "/../../public/assets/images/horses/";

                    $imageFile = $folder . $nameImageHorse;

                    if (file_exists($imageFile)) {
                        unlink($imageFile);
                    }

                    $extension = strtolower(pathinfo($imageHorse['name'], PATHINFO_EXTENSION));


                    $nameImage = $nameHorse;

                    $i = 0;
                    while (file_exists($folder . $nameImage . '.' . $extension)) {
                        $i++;
                        $nameImage = $nameHorse . $i;
                    }

                    move_uploaded_file($imageHorse['tmp_name'], $folder . $nameImage . '.' . $extension);

                    $linkImage = "/public/assets/images/horses/" . $nameImage . '.' . $extension;
                    // $extension = strtolower(pathinfo($imageHorse['name'], PATHINFO_EXTENSION));

                    // $folder = __DIR__ . "/../../public/assets/images/horses/";

                    // move_uploaded_file($imageHorse['tmp_name'], $folder . $nameImageHorse . '.' . $extension);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => "L'image de doit pas dépasser 2Mo."
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => "Les formats d'image accepté sont : png, jpeg, jpg et svg"
                );
                return json_encode($response);
                die;
            }
        } else if (filter_var($imageHorse, FILTER_VALIDATE_URL)) {
            $linkImage = "/public/assets/images/horses/" . $nameImageHorse;
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de mettre une image.'
            );
            return json_encode($response);
            die;
        }


        if (isset($nameHorse) && !empty($nameHorse) && isset($linkImage) && !empty($linkImage) && isset($birthdateHorse) && !empty($birthdateHorse)) {
            if (strlen($nameHorse) <= 50) {
                $nameHorse = htmlspecialchars($nameHorse);

                list($year, $month, $day) = explode("-", $birthdateHorse);

                if (checkdate($month, $day, $year) && strtotime($birthdateHorse) < time()) {
                    $birthdateHorse = htmlspecialchars($birthdateHorse);

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
                            $reponse = $HorseRepository->editHorseUser($idHorse, $nameHorse, $linkImage, $birthdateHorse, $heightHorse, $coatHorse);

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
                        'message' => 'Merci de renter une date valide.'
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

    function deleteHorse($idHorse, $linkImageHorse)
    {
        $imageFile = __DIR__ . "/../.." . $linkImageHorse;

        if (file_exists($imageFile)) {
            unlink($imageFile);
        }

        $HorseRepository = new HorseRepository;
        $reponse = $HorseRepository->deleteHorse($idHorse);
        return json_encode($reponse);
    }
}
