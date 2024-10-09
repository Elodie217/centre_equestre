<?php

namespace src\Controllers;

use src\Repositories\BoardingRepository;
use src\Services\Reponse;

class BoardingController
{

    use Reponse;

    public function allBoarding()
    {
        $BoardingRepository = new BoardingRepository;
        $reponse = $BoardingRepository->getAllBoarding();
        return json_encode($reponse);
    }

    function boardingById($idBoarding)
    {
        $BoardingRepository = new BoardingRepository;
        $reponse = $BoardingRepository->getBoardingById($idBoarding);
        return json_encode($reponse);
    }

    function boardingHorse($idBoarding)
    {
        $BoardingRepository = new BoardingRepository;
        $reponse = $BoardingRepository->getBoardingHorse($idBoarding);
        return json_encode($reponse);
    }


    public function editBoarding($idBoarding, $nameBoardingEdit, $priceBoardingEdit, $serviceBoardingEdit, $serviceBisBoardingEdit)
    {
        if (isset($nameBoardingEdit) && !empty($nameBoardingEdit) && isset($priceBoardingEdit) && !empty($priceBoardingEdit) && isset($serviceBoardingEdit) && !empty($serviceBoardingEdit)) {
            if (strlen($nameBoardingEdit) <= 255) {
                $nameBoardingEdit = htmlspecialchars($nameBoardingEdit);

                if (strlen($serviceBoardingEdit) <= 255) {
                    $serviceBoardingEdit = htmlspecialchars($serviceBoardingEdit);

                    if (strlen($serviceBisBoardingEdit) <= 255 || $serviceBisBoardingEdit = '') {
                        if ($serviceBisBoardingEdit == '') {
                            $serviceBisBoardingEdit = NULL;
                        } else {
                            $serviceBisBoardingEdit = htmlspecialchars($serviceBisBoardingEdit);
                        }

                        if (is_int((int)$priceBoardingEdit) && (int)$priceBoardingEdit > 0 && (int)$priceBoardingEdit < 2000) {
                            $priceBoardingEdit = htmlspecialchars($priceBoardingEdit);

                            $BoardingRepository = new BoardingRepository;
                            $reponse = $BoardingRepository->editBoarding($idBoarding, $nameBoardingEdit, $priceBoardingEdit, $serviceBoardingEdit, $serviceBisBoardingEdit);
                            return json_encode($reponse);
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'Merci de rentrer un prix valide.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Le nom doit faire au maximum 255 caractères.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Le nom doit faire au maximum 255 caractères.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom doit faire au maximum 255 caractères.'
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
}
