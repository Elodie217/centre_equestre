<?php

namespace src\Models;

class Horse
{
    private $id_horse;
    private $name_horse;
    private $birthdate_horse;
    private $image_horse;
    private $vaccin_horse;
    private $id_box;
    private $id_user;
    private $id_boarding;
    private $name_box;
    private $firstname_user;
    private $lastname_user;


    function __construct(array $datas = array())
    {
        foreach ($datas as $key => $value) {
            $parts = explode('_', $key);
            $setter = 'set';
            foreach ($parts as $part) {
                $setter .= ucfirst(strtolower($part));
            }

            $this->$setter($value);
        }
    }


    /**
     * Get the value of id_horse
     */
    public function getIdHorse()
    {
        return $this->id_horse;
    }

    /**
     * Set the value of id_horse
     */
    public function setIdHorse($id_horse): self
    {
        $this->id_horse = $id_horse;

        return $this;
    }

    /**
     * Get the value of name_horse
     */
    public function getNameHorse()
    {
        return $this->name_horse;
    }

    /**
     * Set the value of name_horse
     */
    public function setNameHorse($name_horse): self
    {
        $this->name_horse = $name_horse;

        return $this;
    }

    /**
     * Get the value of birthdate_horse
     */
    public function getBirthdateHorse()
    {
        return $this->birthdate_horse;
    }

    /**
     * Set the value of birthdate_horse
     */
    public function setBirthdateHorse($birthdate_horse): self
    {
        $this->birthdate_horse = $birthdate_horse;

        return $this;
    }

    /**
     * Get the value of image_horse
     */
    public function getImageHorse()
    {
        return $this->image_horse;
    }

    /**
     * Set the value of image_horse
     */
    public function setImageHorse($image_horse): self
    {
        $this->image_horse = $image_horse;

        return $this;
    }

    /**
     * Get the value of vaccin_horse
     */
    public function getVaccinHorse()
    {
        return $this->vaccin_horse;
    }

    /**
     * Set the value of vaccin_horse
     */
    public function setVaccinHorse($vaccin_horse): self
    {
        $this->vaccin_horse = $vaccin_horse;

        return $this;
    }

    /**
     * Get the value of id_box
     */
    public function getIdBox()
    {
        return $this->id_box;
    }

    /**
     * Set the value of id_box
     */
    public function setIdBox($id_box): self
    {
        $this->id_box = $id_box;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     */
    public function setIdUser($id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_boarding
     */
    public function getIdBoarding()
    {
        return $this->id_boarding;
    }

    /**
     * Set the value of id_boarding
     */
    public function setIdBoarding($id_boarding): self
    {
        $this->id_boarding = $id_boarding;

        return $this;
    }


    /**
     * Get the value of name_box
     */
    public function getNameBox()
    {
        return $this->name_box;
    }

    /**
     * Set the value of name_box
     */
    public function setNameBox($name_box): self
    {
        $this->name_box = $name_box;

        return $this;
    }

    /**
     * Get the value of firstname_user
     */
    public function getFirstnameUser()
    {
        return $this->firstname_user;
    }

    /**
     * Set the value of firstname_user
     */
    public function setFirstnameUser($firstname_user): self
    {
        $this->firstname_user = $firstname_user;

        return $this;
    }

    /**
     * Get the value of lastname_user
     */
    public function getLastnameUser()
    {
        return $this->lastname_user;
    }

    /**
     * Set the value of lastname_user
     */
    public function setLastnameUser($lastname_user): self
    {
        $this->lastname_user = $lastname_user;

        return $this;
    }


    public function getObjectToArray(): array
    {
        return ['id_horse' => $this->getIdHorse(), 'name_horse' => $this->getNameHorse(), 'birthdate_horse' => $this->getBirthdateHorse(), 'image_horse' => $this->getImageHorse(), 'vaccin_horse' => $this->getVaccinHorse(), 'id_box' => $this->getIdBox(), 'id_user' => $this->getIdUser(), 'id_boarding' => $this->getIdBoarding(), 'name_box' => $this->getNameBox(), 'firstname_user' => $this->getFirstnameUser(), 'lastname_user' => $this->getLastnameUser()];
    }
}
