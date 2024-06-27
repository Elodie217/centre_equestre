<?php

namespace src\Controllers;

use src\Repositories\ContactRepository;

class ContactController
{

    public function sendContact($lastnameContact, $firstnameContact, $emailContact, $messageContact)
    {
        if (isset($lastnameContact) && !empty($lastnameContact) && isset($firstnameContact) && !empty($firstnameContact) && isset($emailContact) && !empty($emailContact) && isset($messageContact) && !empty($messageContact)) {
            if (strlen($lastnameContact) <= 50) {
                $lastnameContact = htmlspecialchars($lastnameContact);

                if (strlen($firstnameContact) <= 50) {
                    $firstnameContact = htmlspecialchars($firstnameContact);

                    if (strlen($messageContact) <= 500) {
                        $messageContact = htmlspecialchars($messageContact);

                        if (filter_var($emailContact, FILTER_VALIDATE_EMAIL)) {
                            $emailContact = htmlspecialchars($emailContact);

                            $ContactRepository = new ContactRepository;
                            $reponse = $ContactRepository->sendContact($lastnameContact, $firstnameContact, $emailContact, $messageContact);
                            return json_encode($reponse);
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'Merci de rentrer un email valide.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Le message doit faire au maximum 500 caractères.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Votre prénom doit faire au maximum 50 caractères.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Votre nom doit faire au maximum 50 caractères.'
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
