<?php

namespace src\Controllers;

use src\Repositories\UserRepository;
use src\Services\Reponse;

class UserController
{
    public function allUser()
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->getAllUser();
        return json_encode($reponse);
    }
}
