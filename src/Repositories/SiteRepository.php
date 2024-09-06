<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Site;

class SiteRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function getAllSite()
    {

        $sql = "SELECT * FROM " . PREFIXE . "site";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Site::class);
        $retour =  [];


        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }

        return $retour;
    }

    public function getSiteSoon()
    {

        $sql = "SELECT " . PREFIXE . "site.id_site, " . PREFIXE . "site.element_site, " . PREFIXE . "site.description_site FROM " . PREFIXE . "site
        WHERE " . PREFIXE . "site.element_site =  'title_soon'
        OR " . PREFIXE . "site.element_site =  'date_soon'
        OR " . PREFIXE . "site.element_site =  'description_soon'
        OR " . PREFIXE . "site.element_site =  'image_soon'";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Site::class);
        $retour =  [];


        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }

        return $retour;
    }


    public function editSoonSite(
        $titleEditSoon,
        $dateEditSoon,
        $descriptionEditSoon,
        $imageEditSoon
    ) {
        $sql = "UPDATE " . PREFIXE . "site
        SET description_site = CASE
            WHEN element_site = 'title_soon' THEN :titleEditSoon
            WHEN element_site = 'date_soon' THEN :dateEditSoon
            WHEN element_site = 'description_soon' THEN :descriptionEditSoon
            WHEN element_site = 'image_soon' THEN :imageEditSoon
            ELSE description_site
        END";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':titleEditSoon', $titleEditSoon);
        $statement->bindParam(':dateEditSoon', $dateEditSoon);
        $statement->bindParam(':descriptionEditSoon', $descriptionEditSoon);
        $statement->bindParam(':imageEditSoon', $imageEditSoon);


        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => 'Le prochaine événement a bien été modifié !'
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }
}
