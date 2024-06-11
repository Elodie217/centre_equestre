<?php

use src\Controllers\AdminController;
use src\Controllers\HomeController;
use src\Controllers\HorseController;
use src\Services\Routing;



$route = $_SERVER['REDIRECT_URL'];
$methode = $_SERVER['REQUEST_METHOD'];

$routeComposee = Routing::routeComposee($route);

$HomeController = new HomeController;
$AdminController = new AdminController;
$HorseController = new HorseController;


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

            case $routeComposee[1] == "horses":
                switch ($route) {
                    case $routeComposee[2] == "add":
                        $data = file_get_contents("php://input");

                        $addhorse = json_decode($data, true);

                        echo $HorseController->addhorse($addhorse['nameHorse'], $addhorse['imageHorse'], $addhorse['breedHorse'], $addhorse['horseUser'], $addhorse['horseBox']);

                    default:
                        $AdminController->horses();
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
