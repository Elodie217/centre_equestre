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
use src\Controllers\SiteController;
use src\Controllers\UserController;
use src\Services\JWTService;
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
$SiteController = new SiteController;


if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $ConnectedUser = $_SESSION['user'];
}


switch ($route) {
    case HOME_URL:
        $HomeController->home();
        die;

    case HOME_URL . 'siteSoon/all':
        echo $SiteController->siteSoon();
        die;

        // Register
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
                    $HomeController->home();
                }
                die;
        }

    case $routeComposee[0] == "emailingForgetPassword":
        switch ($route) {
            case $routeComposee[1] == "email":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->emailForgetPassword($user['loginForgetPassword'], $user['emailForgetPassword']);
                die;

            default:
                $HomeController->emailingForgetPassword();
                die;
        }
    case $routeComposee[0] == "forgotPassword":
        switch ($route) {
            case $routeComposee[1] == "userLogin":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->userLoginVerification($user['idForgotPassword'], $user['loginUser']);
                die;
            case $routeComposee[1] == "user":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->userById($user['idForgotPasswordUser']);
                die;
            case $routeComposee[1] == "change":
                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                echo $UserController->change($user['idUser'], $user['loginUser'], $user['passwordForgotPasswordUser'], $user['passwordbisForgotPasswordUser']);
                die;
            default:
                if (isset($routeComposee[1]) && !empty($routeComposee[1])) {
                    $HomeController->forgotPassword($routeComposee[1]);
                } else {
                    $HomeController->home();
                }
                die;
        }

    case HOME_URL . 'lesson':
        $HomeController->lesson();
        die;

    case HOME_URL . 'facility':
        $HomeController->facility();
        die;

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

    case HOME_URL . 'privacypolicy':
        $HomeController->privacyPolicy();
        die;

    case HOME_URL . 'legalnotices':
        $HomeController->legalNotices();
        die;


    case $routeComposee[0] == "user":
        if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "User") {


            switch ($route) {

                    // User Lesson
                case $routeComposee[1] == "lessons":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {
                                echo $LessonController->allLessonsByIdUser($_SESSION['user']->getIdUser());

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "idlevel":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {
                                echo $LessonController->allLessonsByIdLevelUser();

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "change":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                $lessons = json_decode($data, true);

                                echo $LessonController->changeLessonUser($lessons['idNewLesson'], $lessons['idOldLesson']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                $lesson = json_decode($data, true);

                                echo $LessonController->deleteLessonUser($lesson['idLesson']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $HomeController->lessonUser();
                            die;
                    }

                    // User horse
                case $routeComposee[1] == "horses":
                    switch ($route) {
                        case $routeComposee[2] == "byiduser":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                echo $HorseController->byIdUser();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                $horseid = json_decode($data, true);

                                echo $HorseController->horseById($horseid['idHorse']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                if ($_FILES) {
                                    $imageHorse = $_FILES['imageHorse'];
                                } else if ($_POST['imageHorse']) {
                                    $imageHorse = $_POST['imageHorse'];
                                }

                                echo $HorseController->editHorseUser($_POST['idHorse'], $_POST['nameImageHorse'], $_POST['nameHorse'], $imageHorse, $_POST['birthdateHorse'], $_POST['heightHorse'], $_POST['coatHorse']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $HomeController->horsesUser();
                            die;
                    }

                    // User profile
                case $routeComposee[1] == "profile":
                    switch ($route) {
                        case $routeComposee[2] == "userbyid":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                echo $UserController->userById($_SESSION['user']->getIdUser());
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenUser($JWTUser);

                            if ($valideJWT == True) {

                                $editProfileUser = json_decode($data, true);

                                echo $UserController->editProfileUser($editProfileUser['idUserProfileEdit'], $editProfileUser['lastnameUserProfileEdit'], $editProfileUser['firstnameUserProfileEdit'], $editProfileUser['emailUserProfileEdit'], $editProfileUser['phoneUserProfileEdit'], $editProfileUser['birthdateUserProfileEdit'], $editProfileUser['addressUserProfileEdit']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

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

                    // Admin profile 
                case $routeComposee[1] == "profile":
                    switch ($route) {
                        case $routeComposee[2] == "userbyid":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                echo $UserController->userById($_SESSION['user']->getIdUser());

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $editProfileUser = json_decode($data, true);

                                echo $UserController->editProfileUser($editProfileUser['idUserProfileEdit'], $editProfileUser['lastnameUserProfileEdit'], $editProfileUser['firstnameUserProfileEdit'], $editProfileUser['emailUserProfileEdit'], $editProfileUser['phoneUserProfileEdit'], $editProfileUser['birthdateUserProfileEdit'], $editProfileUser['addressUserProfileEdit']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        default:
                            $AdminController->profileAdmin();
                            die;
                    }

                    // Admin lesson
                case $routeComposee[1] == "lessons":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                echo $LessonController->allLessons();

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "add":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $addlesson = json_decode($data, true);

                                echo $LessonController->addLesson($addlesson['titleLessonAdd'], $addlesson['dateLessonAdd'], $addlesson['hourLessonAdd'], $addlesson['placeLessonAdd'], $addlesson['levelsLessonAdd'], $addlesson['usersLessonAdd']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $addlesson = json_decode($data, true);

                                echo $LessonController->editLesson($addlesson['idLesson'], $addlesson['titleLessonEdit'], $addlesson['dateLessonEdit'], $addlesson['hourLessonEdit'], $addlesson['placeLessonEdit'], $addlesson['levelsLessonEdit'], $addlesson['usersLessonEdit']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                $lesson = json_decode($data, true);

                                echo $LessonController->deleteLesson($lesson['idLesson']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->lesson();
                            die;
                    }

                    // Admin Level 
                case $routeComposee[1] == "levels":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                echo $LevelController->allLevels();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        case $routeComposee[2] == "add":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                $addLevel = json_decode($data, true);

                                echo $LevelController->addLevel($addLevel['nameLevel']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $Level = json_decode($data, true);

                                echo $LevelController->deleteLevel($Level['idLevelDelete']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                    }

                    // Admin horse
                case $routeComposee[1] == "horses":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                echo $HorseController->allHorses();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $horseid = json_decode($data, true);

                                echo $HorseController->horseById($horseid['idHorse']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "add":
                            // $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $HorseController->addHorse($_POST['nameHorse'], $_FILES['imageHorse'], $_POST['birthdateHorse'], $_POST['heightHorse'], $_POST['coatHorse'], $_POST['horseUser'], $_POST['horseBox'], $_POST['boardingHorse']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                if ($_FILES) {
                                    $imageHorse = $_FILES['imageHorse'];
                                } else if ($_POST['imageHorse']) {
                                    $imageHorse = $_POST['imageHorse'];
                                }

                                echo $HorseController->editHorse($_POST['idHorse'], $_POST['nameImageHorse'], $_POST['nameHorse'], $imageHorse, $_POST['birthdateHorse'], $_POST['heightHorse'], $_POST['coatHorse'], $_POST['horseUser'], $_POST['horseBox'], $_POST['boardingHorse']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {
                                $horse = json_decode($data, true);

                                echo $HorseController->deleteHorse($horse['idHorse'], $horse["linkImageHorse"]);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->horses();
                            die;
                    }

                    // Admin box
                case $routeComposee[1] == "box":
                    switch ($route) {
                        case $routeComposee[2] == "all":

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $BoxController->allBox();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "horse":

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $BoxController->allBoxHorse();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "add":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $addbox = json_decode($data, true);

                                echo $BoxController->addBox($addbox['nameBox']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $editbox = json_decode($data, true);

                                echo $BoxController->editBox($editbox['idBox'], $editbox['boxEdit']);
                                // echo $BoxController->editBox($editbox['idBox'], $editbox['boxEdit'], $editbox['boxHorseEdit']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $box = json_decode($data, true);

                                echo $BoxController->deleteBox($box['idBox']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->box();
                            die;
                    }

                    // Admin bording 
                case $routeComposee[1] == "boarding":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $BoardingController->allBoarding();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $boardingId = json_decode($data, true);

                                echo $BoardingController->boardingById($boardingId['idBoarding']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "horse":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $boardingId = json_decode($data, true);

                                echo $BoardingController->boardingHorse($boardingId['idBoarding']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $editBoarding = json_decode($data, true);

                                echo $BoardingController->editBoarding($editBoarding['idBoarding'], $editBoarding['nameBoardingEdit'], $editBoarding['priceBoardingEdit'], $editBoarding['serviceBoardingEdit'], $editBoarding['serviceBisBoardingEdit']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->boarding();
                            die;
                    }

                    // Admin user 
                case $routeComposee[1] == "users":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $choiceOrder = json_decode($data, true);

                                echo $UserController->allUser($choiceOrder['name'], $choiceOrder['order']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $userId = json_decode($data, true);

                                echo $UserController->userById($userId['idUser']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "add":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $addUser = json_decode($data, true);


                                echo $UserController->addUser($addUser['lastnameUserAdd'], $addUser['firstnameUserAdd'], $addUser['emailUserAdd'], $addUser['phoneUserAdd'], $addUser['birthdateUserAdd'], $addUser['addressUserAdd'], $addUser['roleUserAdd'], $addUser['levelUserAdd']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "edit":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $editUser = json_decode($data, true);

                                echo $UserController->editUser($editUser['idUserEdit'], $editUser['lastnameUserEdit'], $editUser['firstnameUserEdit'], $editUser['emailUserEdit'], $editUser['phoneUserEdit'], $editUser['birthdateUserEdit'], $editUser['addressUserEdit'], $editUser['roleUserEdit'], $editUser['levelUserEdit']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "disable":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $user = json_decode($data, true);

                                echo $UserController->disableUser($user['idUser']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $user = json_decode($data, true);

                                echo $UserController->deleteUser($user['idUser']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->user();
                            die;
                    }

                    // Admin contact
                case $routeComposee[1] == "contacts":
                    switch ($route) {
                        case $routeComposee[2] == "all":

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $ContactController->allContact();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "id":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $contactId = json_decode($data, true);

                                echo $ContactController->contactById($contactId['idContact']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "status":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $statusId = json_decode($data, true);

                                echo $ContactController->changeStatus($statusId['idStatus'], $statusId['idContact']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        case $routeComposee[2] == "delete":
                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $contact = json_decode($data, true);

                                echo $ContactController->deleteContact($contact['idContact']);
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }

                        default:
                            $AdminController->contact();
                            die;
                    }

                    // Admin site
                case $routeComposee[1] == "site":
                    switch ($route) {
                        case $routeComposee[2] == "all":
                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                echo $SiteController->allSite();
                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        case $routeComposee[2] == "edit":

                            $data = file_get_contents("php://input");

                            $headers = getallheaders();

                            $Authorization = $headers['Authorization'];
                            $JWTUser = ltrim($Authorization, 'Bearer');
                            $JWTUser = ltrim($JWTUser, ' ');

                            $JWT = new JWTService;
                            $valideJWT = $JWT->checkTokenAdmin($JWTUser);

                            if ($valideJWT == True) {

                                $editUser = json_decode($data, true);

                                echo $SiteController->editSoonSite($editUser['titleEditSoon'], $editUser['dateEditSoon'], $editUser['descriptionEditSoon'], $editUser['imageEditSoon']);

                                die;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => "JWT incorrect"
                                );
                                echo json_encode($response);
                                die;
                            }
                        default:
                            $SiteController->site();
                            die;
                    }
                default:
                    header('location: ' . HOME_URL . 'admin/lessons');

                    die;
            }
        } else if (isset($ConnectedUser) && $ConnectedUser->getRoleUser() == "User") {
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
        $HomeController->home();

        die;
}
