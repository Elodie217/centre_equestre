<?php

namespace src\Models;

class User
{
    private $id_user;
    private $password_user;
    private $lastname_user;
    private $firstname_user;
    private $email_user;
    private $phone_user;
    private $address_user;
    private $birthdate_user;
    private $role_user;
    private $actif_user;
    private $gdpr_user;
    private $login_user;
    private $id_level;
    private $name_level;
    private $number_horse;




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
     * Get the value of password_user
     */
    public function getPasswordUser()
    {
        return $this->password_user;
    }

    /**
     * Set the value of password_user
     */
    public function setPasswordUser($password_user): self
    {
        $this->password_user = $password_user;

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
     * Get the value of email_user
     */
    public function getEmailUser()
    {
        return $this->email_user;
    }

    /**
     * Set the value of email_user
     */
    public function setEmailUser($email_user): self
    {
        $this->email_user = $email_user;

        return $this;
    }

    /**
     * Get the value of phone_user
     */
    public function getPhoneUser()
    {
        return $this->phone_user;
    }

    /**
     * Set the value of phone_user
     */
    public function setPhoneUser($phone_user): self
    {
        $this->phone_user = $phone_user;

        return $this;
    }

    /**
     * Get the value of address_user
     */
    public function getAddressUser()
    {
        return $this->address_user;
    }

    /**
     * Set the value of address_user
     */
    public function setAddressUser($address_user): self
    {
        $this->address_user = $address_user;

        return $this;
    }

    /**
     * Get the value of birthdate_user
     */
    public function getBirthdateUser()
    {
        return $this->birthdate_user;
    }

    /**
     * Set the value of birthdate_user
     */
    public function setBirthdateUser($birthdate_user): self
    {
        $this->birthdate_user = $birthdate_user;

        return $this;
    }

    /**
     * Get the value of role_user
     */
    public function getRoleUser()
    {
        return $this->role_user;
    }

    /**
     * Set the value of role_user
     */
    public function setRoleUser($role_user): self
    {
        $this->role_user = $role_user;

        return $this;
    }

    /**
     * Get the value of actif_user
     */
    public function getActifUser()
    {
        return $this->actif_user;
    }

    /**
     * Set the value of actif_user
     */
    public function setActifUser($actif_user): self
    {
        $this->actif_user = $actif_user;

        return $this;
    }

    /**
     * Get the value of gdpr_user
     */
    public function getGdprUser()
    {
        return $this->gdpr_user;
    }

    /**
     * Set the value of gdpr_user
     */
    public function setGdprUser($gdpr_user): self
    {
        $this->gdpr_user = $gdpr_user;

        return $this;
    }

    /**
     * Get the value of login_user
     */
    public function getLoginUser()
    {
        return $this->login_user;
    }

    /**
     * Set the value of login_user
     */
    public function setLoginUser($login_user): self
    {
        $this->login_user = $login_user;

        return $this;
    }

    /**
     * Get the value of id_level
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }

    /**
     * Set the value of id_level
     */
    public function setIdLevel($id_level): self
    {
        $this->id_level = $id_level;

        return $this;
    }

    /**
     * Get the value of name_level
     */
    public function getNameLevel()
    {
        return $this->name_level;
    }

    /**
     * Set the value of name_level
     */
    public function setNameLevel($name_level): self
    {
        $this->name_level = $name_level;

        return $this;
    }

    /**
     * Get the value of number_horse
     */
    public function getNumberHorse()
    {
        return $this->number_horse;
    }

    /**
     * Set the value of number_horse
     */
    public function setNumberHorse($number_horse): self
    {
        $this->number_horse = $number_horse;

        return $this;
    }

    public function getObjectToArray(): array
    {
        return ['id_user' => $this->getIdUser(), 'password_user' => $this->getPasswordUser(), 'lastname_user' => $this->getLastnameUser(), 'firstname_user' => $this->getFirstnameUser(), 'email_user' => $this->getEmailUser(), 'phone_user' => $this->getPhoneUser(), 'address_user' => $this->getAddressUser(), 'birthdate_user' => $this->getBirthdateUser(), 'role_user' => $this->getRoleUser(), 'actif_user' => $this->getActifUser(), 'gdpr_user' => $this->getGdprUser(), 'login_user' => $this->getLoginUser(), 'id_level' => $this->getIdLevel(), 'name_level' => $this->getNameLevel(), 'number_horse' => $this->getNumberHorse()];
    }
}
