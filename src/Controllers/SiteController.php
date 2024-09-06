<?php

namespace src\Controllers;

use src\Repositories\SiteRepository;
use src\Services\Reponse;

class SiteController
{

    use Reponse;

    public function site(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("siteAdmin", ["erreur" => $erreur]);
    }

    public function siteSoon()
    {
        $SiteRepository = new SiteRepository;
        $reponse = $SiteRepository->getSiteSoon();
        return json_encode($reponse);
    }

    public function allSite()
    {
        $SiteRepository = new SiteRepository;
        $reponse = $SiteRepository->getAllSite();
        return json_encode($reponse);
    }

    public function editSoonSite(
        $titleEditSoon,
        $dateEditSoon,
        $descriptionEditSoon,
        $imageEditSoon
    ) {

        if (isset($titleEditSoon) && !empty($titleEditSoon) && isset($dateEditSoon) && !empty($dateEditSoon) && isset($descriptionEditSoon) && !empty($descriptionEditSoon) && isset($imageEditSoon) && !empty($imageEditSoon)) {
            if (strlen($titleEditSoon) <= 1000 && strlen($dateEditSoon) <= 1000 && strlen($descriptionEditSoon) <= 1000 && strlen($imageEditSoon) <= 1000) {
                $titleEditSoon = htmlspecialchars($titleEditSoon);
                $dateEditSoon = htmlspecialchars($dateEditSoon);
                $descriptionEditSoon = htmlspecialchars($descriptionEditSoon);


                if (filter_var($imageEditSoon, FILTER_VALIDATE_URL)) {
                    $imageEditSoon = htmlspecialchars($imageEditSoon);


                    $SiteRepository = new SiteRepository;
                    $reponse = $SiteRepository->editSoonSite(
                        $titleEditSoon,
                        $dateEditSoon,
                        $descriptionEditSoon,
                        $imageEditSoon
                    );

                    return json_encode($reponse);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Merci de renter un URL valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Les informations doivent faire au maximum 1000 caractères.'
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
