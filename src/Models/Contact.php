<?php

namespace src\Models;

class Contact
{
    private $id_contact;
    private $email_contact;
    private $lastname_contact;
    private $firstname_contact;
    private $message_contact;
    private $date_contact;
    private $id_status;


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
     * Get the value of id_contact
     */
    public function getIdContact()
    {
        return $this->id_contact;
    }

    /**
     * Set the value of id_contact
     */
    public function setIdContact($id_contact): self
    {
        $this->id_contact = $id_contact;

        return $this;
    }

    /**
     * Get the value of email_contact
     */
    public function getEmailContact()
    {
        return $this->email_contact;
    }

    /**
     * Set the value of email_contact
     */
    public function setEmailContact($email_contact): self
    {
        $this->email_contact = $email_contact;

        return $this;
    }

    /**
     * Get the value of lastname_contact
     */
    public function getLastnameContact()
    {
        return $this->lastname_contact;
    }

    /**
     * Set the value of lastname_contact
     */
    public function setLastnameContact($lastname_contact): self
    {
        $this->lastname_contact = $lastname_contact;

        return $this;
    }

    /**
     * Get the value of firstname_contact
     */
    public function getFirstnameContact()
    {
        return $this->firstname_contact;
    }

    /**
     * Set the value of firstname_contact
     */
    public function setFirstnameContact($firstname_contact): self
    {
        $this->firstname_contact = $firstname_contact;

        return $this;
    }

    /**
     * Get the value of message_contact
     */
    public function getMessageContact()
    {
        return $this->message_contact;
    }

    /**
     * Set the value of message_contact
     */
    public function setMessageContact($message_contact): self
    {
        $this->message_contact = $message_contact;

        return $this;
    }

    /**
     * Get the value of date_contact
     */
    public function getDateContact()
    {
        return $this->date_contact;
    }

    /**
     * Set the value of date_contact
     */
    public function setDateContact($date_contact): self
    {
        $this->date_contact = $date_contact;

        return $this;
    }

    /**
     * Get the value of id_status
     */
    public function getIdStatus()
    {
        return $this->id_status;
    }

    /**
     * Set the value of id_status
     */
    public function setIdStatus($id_status): self
    {
        $this->id_status = $id_status;

        return $this;
    }


    public function getObjectToArray(): array
    {
        return ['id_contact' => $this->getIdContact(), 'email_contact' => $this->getEmailContact(), 'lastname_contact' => $this->getLastnameContact(), 'firstname_contact' => $this->getFirstnameContact(), 'message_contact' => $this->getMessageContact(), 'date_contact' => $this->getDateContact(), 'id_status' => $this->getIdStatus()];
    }
}
