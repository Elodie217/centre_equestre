<?php

namespace src\Controllers;

use src\Models\Box;
use src\Repositories\BoxRepository;
use src\Services\Reponse;

class BoxController
{
    public function allBox()
    {
        $BoxRepository = new BoxRepository;
        $reponse = $BoxRepository->getAllBox();
        return json_encode($reponse);
    }

    public function allBoxHorse()
    {
        $BoxRepository = new BoxRepository;
        $reponse = $BoxRepository->getAllBoxHorse();
        return json_encode($reponse);
    }

    public function addBox($nameBox)
    {
        if (isset($nameBox) && !empty($nameBox)) {
            if (strlen($nameBox) <= 50) {
                $nameBox = htmlspecialchars($nameBox);


                $BoxRepository = new BoxRepository;
                $reponse = $BoxRepository->addBox($nameBox);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom du box doit faire au maximum 50 caractères.'
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

    public function editBox($idBox, $boxEdit)
    {

        if (isset($boxEdit) && !empty($boxEdit)) {
            if (strlen($boxEdit) <= 50) {
                $boxEdit = htmlspecialchars($boxEdit);
                $BoxRepository = new BoxRepository;
                $reponse = $BoxRepository->editBox($idBox, $boxEdit);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom du box doit faire au maximum 50 caractères.'
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

    public function deleteBox($idBox)
    {
        $BoxRepository = new BoxRepository;
        $reponse = $BoxRepository->deleteBox($idBox);
        return json_encode($reponse);
    }
}
