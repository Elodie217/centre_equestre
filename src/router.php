<?php

use src\Controllers\AdminController;
use src\Controllers\BoxController;
use src\Controllers\HomeController;
use src\Controllers\HorseController;
use src\Controllers\LessonController;
use src\Controllers\LevelController;
use src\Controllers\UserController;
use src\Services\Routing;



$route = $_SERVER['REDIRECT_URL'];
$methode = $_SERVER['REQUEST_METHOD'];

$routeComposee = Routing::routeComposee($route);

$HomeController = new HomeController;
$AdminController = new AdminController;
$HorseController = new HorseController;
$BoxController = new BoxController;
$UserController = new UserController;
$LessonController = new LessonController;
$LevelController = new LevelController;




switch ($route) {
    case HOME_URL:
        $HomeController->index();
        break;
    case HOME_URL . 'photos':
        $HomeController->photos();
        break;
    case $routeComposee[0] == "admin":
        switch ($route) {
            case $routeComposee[1] == "accueil":
                // $data = file_get_contents("php://input");

                // $Cours = json_decode($data, true);

                // echo $CoursController->signatureApprenant($Cours['Id_cours'], $Cours['Code_cours']);
                die;

            case $routeComposee[1] == "lessons":
                switch ($route) {
                    case $routeComposee[2] == "all":

                        echo $LessonController->allLessons();
                        die;

                        // case $routeComposee[2] == "id":
                        //     $data = file_get_contents("php://input");

                        //     $horseid = json_decode($data, true);

                        //     echo $HorseController->horseById($horseid['idHorse']);
                        //     die;

                    case $routeComposee[2] == "add":
                        $data = file_get_contents("php://input");

                        $addlesson = json_decode($data, true);

                        echo $LessonController->addLesson($addlesson['dateLessonAdd'], $addlesson['hourLessonAdd'], $addlesson['placeLessonAdd'], $addlesson['levelsLessonAdd'], $addlesson['usersLessonAdd']);

                        die;

                    case $routeComposee[2] == "edit":
                        $data = file_get_contents("php://input");

                        $addlesson = json_decode($data, true);

                        echo $LessonController->editLesson($addlesson['idLesson'], $addlesson['dateLessonEdit'], $addlesson['hourLessonEdit'], $addlesson['placeLessonEdit'], $addlesson['levelsLessonEdit'], $addlesson['usersLessonEdit']);

                        die;

                    case $routeComposee[2] == "delete":
                        $data = file_get_contents("php://input");

                        $lesson = json_decode($data, true);

                        echo $LessonController->deleteLesson($lesson['idLesson']);
                        die;

                    default:
                        $AdminController->lesson();
                        die;
                }
            case $routeComposee[1] == "levels":
                switch ($route) {
                    case $routeComposee[2] == "all":

                        echo $LevelController->allLevels();
                        die;

                        // case $routeComposee[2] == "id":
                        //     $data = file_get_contents("php://input");

                        //     $horseid = json_decode($data, true);

                        //     echo $HorseController->horseById($horseid['idHorse']);
                        //     die;

                        // case $routeComposee[2] == "add":
                        //     $data = file_get_contents("php://input");

                        //     $addlesson = json_decode($data, true);

                        //     echo $LevelController->addLesson($addlesson['dateLessonAdd'], $addlesson['hourLessonAdd'], $addlesson['placeLessonAdd'], $addlesson['levelsLessonAdd']);
                        //     die;

                        // case $routeComposee[2] == "edit":
                        //     $data = file_get_contents("php://input");

                        //     $addhorse = json_decode($data, true);

                        //     echo $HorseController->editHorse($addhorse['idHorse'], $addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['birthdateHorse'], $addhorse['horseUser'], $addhorse['horseBox']);
                        //     die;

                        // case $routeComposee[2] == "delete":
                        //     $data = file_get_contents("php://input");

                        //     $horse = json_decode($data, true);

                        //     echo $HorseController->deleteHorse($horse['idHorse']);
                        //     die;

                }
            case $routeComposee[1] == "horses":
                switch ($route) {
                    case $routeComposee[2] == "all":

                        echo $HorseController->allHorses();
                        die;

                    case $routeComposee[2] == "id":
                        $data = file_get_contents("php://input");

                        $horseid = json_decode($data, true);

                        echo $HorseController->horseById($horseid['idHorse']);
                        die;

                    case $routeComposee[2] == "add":
                        $data = file_get_contents("php://input");

                        $addhorse = json_decode($data, true);

                        echo $HorseController->addHorse($addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['birthdateHorse'], $addhorse['horseUser'], $addhorse['horseBox']);
                        die;

                    case $routeComposee[2] == "edit":
                        $data = file_get_contents("php://input");

                        $addhorse = json_decode($data, true);

                        echo $HorseController->editHorse($addhorse['idHorse'], $addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['birthdateHorse'], $addhorse['horseUser'], $addhorse['horseBox']);
                        die;

                    case $routeComposee[2] == "delete":
                        $data = file_get_contents("php://input");

                        $horse = json_decode($data, true);

                        echo $HorseController->deleteHorse($horse['idHorse']);
                        die;

                    default:
                        $AdminController->horses();
                        die;
                }
            case $routeComposee[1] == "box":
                switch ($route) {
                    case $routeComposee[2] == "all":

                        echo $BoxController->allBox();
                        die;

                    case $routeComposee[2] == "horse":

                        echo $BoxController->allBoxHorse();
                        die;

                    case $routeComposee[2] == "add":
                        $data = file_get_contents("php://input");

                        $addbox = json_decode($data, true);

                        echo $BoxController->addBox($addbox['nameBox']);
                        die;

                    case $routeComposee[2] == "edit":
                        $data = file_get_contents("php://input");

                        $editbox = json_decode($data, true);

                        echo $BoxController->editBox($editbox['idBox'], $editbox['boxEdit']);
                        // echo $BoxController->editBox($editbox['idBox'], $editbox['boxEdit'], $editbox['boxHorseEdit']);
                        die;

                    case $routeComposee[2] == "delete":
                        $data = file_get_contents("php://input");

                        $box = json_decode($data, true);

                        echo $BoxController->deleteBox($box['idBox']);
                        die;

                    default:
                        $AdminController->box();
                        die;
                }
            case $routeComposee[1] == "users":
                switch ($route) {
                    case $routeComposee[2] == "all":

                        echo $UserController->allUser();
                        die;

                    case $routeComposee[2] == "id":
                        $data = file_get_contents("php://input");

                        $userId = json_decode($data, true);

                        echo $UserController->userById($userId['idUser']);
                        die;
                        // case $routeComposee[2] == "add":
                        // $data = file_get_contents("php://input");

                        // $addhorse = json_decode($data, true);

                        // echo $HorseController->addHorse($addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['birthdateHorse'], $addhorse['horseUser'], $addhorse['horseBox']);
                        // die;
                        // case $routeComposee[2] == "delete":
                        // $data = file_get_contents("php://input");

                        // $horse = json_decode($data, true);

                        // echo $HorseController->deleteHorse($horse['idHorse']);
                        // die;

                    default:
                        $AdminController->user();
                        die;
                }
            default:
                echo "default de l'admin";
                die;
        }

    default:
        echo 'Bah  mdr';
        break;
}
