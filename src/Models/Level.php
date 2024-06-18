<?php

namespace src\Models;

class Level
{
    private $id_level;
    private $name_level;


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


    public function getObjectToArray(): array
    {
        return ['id_level' => $this->getIdLevel(), 'name_level' => $this->getNameLevel()];
    }
}
