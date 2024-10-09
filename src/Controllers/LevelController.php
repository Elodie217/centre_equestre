<?php

namespace src\Controllers;

use src\Repositories\HorseRepository;
use src\Repositories\LessonRepository;
use src\Repositories\LevelRepository;
use src\Services\Reponse;

class LevelController
{

    use Reponse;


    public function allLevels()
    {
        $LevelRepository = new LevelRepository;
        $reponse = $LevelRepository->getAllLevels();
        return json_encode($reponse);
    }

    public function addLevel($nameLevel)
    {
        if (isset($nameLevel) && !empty($nameLevel)) {
            if (strlen($nameLevel) <= 50) {
                $nameLevel = htmlspecialchars($nameLevel);


                $LevelRepository = new LevelRepository;
                $reponse = $LevelRepository->addLevel($nameLevel);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom du niveau doit faire au maximum 50 caractères.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir le niveau.'
            );
            return json_encode($response);
            die;
        }
    }


    function deleteLevel($idLevel)
    {
        $LevelRepository = new LevelRepository;
        $reponse = $LevelRepository->deleteLevel($idLevel);
        return json_encode($reponse);
    }
}
