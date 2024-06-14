<?php

namespace src\Models;

class Box
{
    private $id_box;
    private $name_box;
    private $name_horse;
    private $id_horse;



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

    public function getObjectToArray(): array
    {
        return ['id_box' => $this->getIdBox(), 'name_box' => $this->getNameBox(), 'name_horse' => $this->getNameHorse(), 'id_horse' => $this->getIdHorse()];
    }
}
