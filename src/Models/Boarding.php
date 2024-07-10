<?php

namespace src\Models;

class Boarding
{
    private $id_boarding;
    private $name_boarding;


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
     * Get the value of name_boarding
     */
    public function getNameBoarding()
    {
        return $this->name_boarding;
    }

    /**
     * Set the value of name_boarding
     */
    public function setNameBoarding($name_boarding): self
    {
        $this->name_boarding = $name_boarding;

        return $this;
    }


    public function getObjectToArray(): array
    {
        return ['id_boarding' => $this->getIdBoarding(), 'name_boarding' => $this->getNameBoarding()];
    }
}
