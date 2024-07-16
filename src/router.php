<?php
session_start();

use src\Controllers\AdminController;
use src\Controllers\BoardingController;
use src\Controllers\BoxController;
use src\Controllers\ContactController;
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
$ContactController = new ContactController;
$BoardingController = new BoardingController;


if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $ConnectedUser = $_SESSION['user'];
}


switch ($route) {
    case HOME_URL:
        $HomeController->index();
        die;

    case $routeComposee[0] == "register":
        switch ($route) {
            case $routeComposee[1] == "userLogin":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->userLoginVerification($user['idNewUser'], $user['loginUser']);
                die;
            case $routeComposee[1] == "user":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->userById($user['idNewUser']);
                die;
            case $routeComposee[1] == "registration":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->registration($user['idUser'], $user['loginUser'], $user['lastnameUserRegister'], $user['firstnameUserRegister'], $user['emailUserRegister'], $user['phoneUserRegister'], $user['birthdateUserRegister'], $user['addressUserRegister'], $user['passwordRegister'], $user['passwordRegisterBis']);
                die;
            default:
                if (isset($routeComposee[1]) && !empty($routeComposee[1])) {
                    $HomeController->register($routeComposee[1]);
                } else {
                    var_dump($routeComposee);
                }
                die;
        }

    case $routeComposee[0] == "horses":
        switch ($route) {
            case $routeComposee[1] == "all":

                echo $HorseController->allHorses();
                die;
            default:
                $HomeController->horses();
                die;
        }

    case HOME_URL . 'board':
        $HomeController->board();
        die;

    case $routeComposee[0] == "contact":
        switch ($route) {
            case $routeComposee[1] == "send":
                $data = file_get_contents("php://input");

                $contact = json_decode($data, true);

                echo $ContactController->sendContact($contact['lastnameContact'], $contact['firstnameContact'], $contact['emailContact'], $contact['messageContact']);

                die;
            default:
                $HomeController->contact();
                die;
        }

    case HOME_URL . 'photos':
        $HomeController->photos();
        die;


    case $routeComposee[0] == "login":
        if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "Admin") {
            header('location: ' . HOME_URL . 'admin/lessons');
            die;
        } else if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "User") {
            header('location: ' . HOME_URL . 'user/lessons');
            die;
        } else {
            switch ($route) {
                case $routeComposee[1] == "connection":
                    $data = file_get_contents("php://input");

                    $loginDatas = json_decode($data, true);

                    echo $HomeController->LoginConnection($loginDatas['login'], $loginDatas['passwordLogin']);

                    die;
                default:
                    $HomeController->login();
                    die;
            }
        }


    case $routeComposee[0] == "user":
        if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "User") {


            switch ($route) {

                case $routeComposee[1] == "lessons":
                    switch ($route) {
                        case $routeComposee[2] == "all":

                            echo $LessonController->allLessonsByIdUser($_SESSION['user']->getIdUser());
                            die;

                        case $routeComposee[2] == "idlevel":

                            echo $LessonController->allLessonsByIdLevelUser();
                            die;

                        case $routeComposee[2] == "change":
                            $data = file_get_contents("php://input");

                            $lessons = json_decode($data, true);

                            echo $LessonController->changeLessonUser($lessons['idNewLesson'], $lessons['idOldLesson']);
                            die;

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $lesson = json_decode($data, true);

                            echo $LessonController->deleteLessonUser($lesson['idLesson']);
                            die;


                        default:
                            $HomeController->lessonUser();
                            die;
                    }

                case $routeComposee[1] == "horses":
                    switch ($route) {
                        case $routeComposee[2] == "byiduser":

                            echo $HorseController->byIdUser();
                            die;

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $horseid = json_decode($data, true);

                            echo $HorseController->horseById($horseid['idHorse']);
                            die;
                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $edithorse = json_decode($data, true);

                            echo $HorseController->editHorseUser($edithorse['idHorse'], $edithorse['nameHorse'], $edithorse['imageHorse'], $edithorse['birthdateHorse'], $edithorse['heightHorse'], $edithorse['coatHorse']);
                            die;

                        default:
                            $HomeController->horsesUser();
                            die;
                    }

                case $routeComposee[1] == "profile":
                    switch ($route) {
                        case $routeComposee[2] == "userbyid":

                            echo $UserController->userById($_SESSION['user']->getIdUser());
                            die;
                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $editProfileUser = json_decode($data, true);

                            echo $UserController->editProfileUser($editProfileUser['idUserProfileEdit'], $editProfileUser['lastnameUserProfileEdit'], $editProfileUser['firstnameUserProfileEdit'], $editProfileUser['emailUserProfileEdit'], $editProfileUser['phoneUserProfileEdit'], $editProfileUser['birthdateUserProfileEdit'], $editProfileUser['addressUserProfileEdit']);
                            die;

                        default:
                            $HomeController->profileUser();
                            die;
                    }
                default:
                    header('location: ' . HOME_URL . 'user/lessons');
                    die;
            }
        } else if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "Admin") {
            header('location: ' . HOME_URL . 'admin/lessons');

            die;
        } else {
            header('location: ' . HOME_URL . 'login');

            die;
        }
    case $routeComposee[0] == "admin":
        if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "Admin") {

            switch ($route) {
                    // case $routeComposee[1] == "accueil":
                    //     die;
                case $routeComposee[1] == "profile":
                    switch ($route) {
                        case $routeComposee[2] == "userbyid":

                            echo $UserController->userById($_SESSION['user']->getIdUser());
                            die;
                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $editProfileUser = json_decode($data, true);

                            echo $UserController->editProfileUser($editProfileUser['idUserProfileEdit'], $editProfileUser['lastnameUserProfileEdit'], $editProfileUser['firstnameUserProfileEdit'], $editProfileUser['emailUserProfileEdit'], $editProfileUser['phoneUserProfileEdit'], $editProfileUser['birthdateUserProfileEdit'], $editProfileUser['addressUserProfileEdit']);
                            die;

                        default:
                            $AdminController->profileAdmin();
                            die;
                    }

                case $routeComposee[1] == "lessons":
                    switch ($route) {
                        case $routeComposee[2] == "all":

                            echo $LessonController->allLessons();
                            die;

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

                            echo $HorseController->addHorse($addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['birthdateHorse'], $addhorse['heightHorse'], $addhorse['coatHorse'], $addhorse['horseUser'], $addhorse['horseBox'], $addhorse['boardingHorse']);

                            die;

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $edithorse = json_decode($data, true);

                            echo $HorseController->editHorse($edithorse['idHorse'], $edithorse['nameHorse'], $edithorse['imageHorse'], $edithorse['birthdateHorse'], $edithorse['heightHorse'], $edithorse['coatHorse'], $edithorse['horseUser'], $edithorse['horseBox'], $edithorse['boardingHorse']);
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
                case $routeComposee[1] == "boarding":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            echo $BoardingController->allBoarding();
                            die;

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $boardingId = json_decode($data, true);

                            echo $BoardingController->boardingById($boardingId['idBoarding']);
                            die;

                        case $routeComposee[2] == "horse":
                            $data = file_get_contents("php://input");

                            $boardingId = json_decode($data, true);

                            echo $BoardingController->boardingHorse($boardingId['idBoarding']);
                            die;

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $editBoarding = json_decode($data, true);

                            echo $BoardingController->editBoarding($editBoarding['idBoarding'], $editBoarding['nameBoardingEdit'], $editBoarding['priceBoardingEdit'], $editBoarding['serviceBoardingEdit'], $editBoarding['serviceBisBoardingEdit']);
                            die;

                        default:
                            $AdminController->boarding();
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

                        case $routeComposee[2] == "add":
                            $data = file_get_contents("php://input");

                            $addUser = json_decode($data, true);


                            echo $UserController->addUser($addUser['lastnameUserAdd'], $addUser['firstnameUserAdd'], $addUser['emailUserAdd'], $addUser['phoneUserAdd'], $addUser['birthdateUserAdd'], $addUser['addressUserAdd'], $addUser['roleUserAdd'], $addUser['levelUserAdd']);
                            die;

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $editUser = json_decode($data, true);

                            echo $UserController->editUser($editUser['idUserEdit'], $editUser['lastnameUserEdit'], $editUser['firstnameUserEdit'], $editUser['emailUserEdit'], $editUser['phoneUserEdit'], $editUser['birthdateUserEdit'], $editUser['addressUserEdit'], $editUser['roleUserEdit'], $editUser['levelUserEdit']);
                            die;

                        case $routeComposee[2] == "disable":
                            $data = file_get_contents("php://input");

                            $user = json_decode($data, true);

                            echo $UserController->disableUser($user['idUser']);
                            die;

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $user = json_decode($data, true);

                            echo $UserController->deleteUser($user['idUser']);
                            die;

                        default:
                            $AdminController->user();
                            die;
                    }
                case $routeComposee[1] == "contacts":
                    switch ($route) {
                        case $routeComposee[2] == "all":

                            echo $ContactController->allContact();
                            die;

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $contactId = json_decode($data, true);

                            echo $ContactController->contactById($contactId['idContact']);
                            die;

                        case $routeComposee[2] == "status":
                            $data = file_get_contents("php://input");

                            $statusId = json_decode($data, true);

                            echo $ContactController->changeStatus($statusId['idStatus'], $statusId['idContact']);

                            die;

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $contact = json_decode($data, true);

                            echo $ContactController->deleteContact($contact['idContact']);
                            die;

                        default:
                            $AdminController->contact();
                            die;
                    }
                default:
                    var_dump("default de l'admin");
                    header('location: ' . HOME_URL . 'admin/lessons');

                    die;
            }
        } else if (isset($_SESSION['user']) && $_SESSION['user']->getRoleUser() == "User") {
            header('location: ' . HOME_URL . 'user/lessons');

            die;
        } else {
            header('location: ' . HOME_URL . 'login');

            die;
        }
    case HOME_URL . 'logout':
        echo $HomeController->logout();
        die;

    default:
        echo 'Bah mdr';
        var_dump($routeComposee[0]);
        die;
}
