<?php

namespace src\Controllers;

use src\Repositories\ContactRepository;

class ContactController
{
    public function allContact()
    {
        $ContactRepository = new ContactRepository;
        $reponse = $ContactRepository->getAllContact();
        return json_encode($reponse);
    }

    public function contactById($idContact)
    {
        $ContactRepository = new ContactRepository;
        $reponse = $ContactRepository->getContactById(htmlspecialchars($idContact));
        return json_encode($reponse);
    }

    public function changeStatus($idStatus, $idContact)
    {
        $ContactRepository = new ContactRepository;
        $reponse = $ContactRepository->changeStatus(htmlspecialchars($idStatus), htmlspecialchars($idContact));
        return json_encode($reponse);
    }


    public function deleteContact($idContact)
    {
        $ContactRepository = new ContactRepository;
        $reponse = $ContactRepository->deleteContact($idContact);
        return json_encode($reponse);
    }
}
