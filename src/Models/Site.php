<?php

namespace src\Models;

class Site
{
    private $id_site;
    private $element_site;
    private $description_site;



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
     * Get the value of id_site
     */
    public function getIdSite()
    {
        return $this->id_site;
    }

    /**
     * Set the value of id_site
     */
    public function setIdSite($id_site): self
    {
        $this->id_site = $id_site;

        return $this;
    }

    /**
     * Get the value of element_site
     */
    public function getElementSite()
    {
        return $this->element_site;
    }

    /**
     * Set the value of element_site
     */
    public function setElementSite($element_site): self
    {
        $this->element_site = $element_site;

        return $this;
    }

    /**
     * Get the value of description_site
     */
    public function getDescriptionSite()
    {
        return $this->description_site;
    }

    /**
     * Set the value of description_site
     */
    public function setDescriptionSite($description_site): self
    {
        $this->description_site = $description_site;

        return $this;
    }


    public function getObjectToArray(): array
    {
        return ['id_site' => $this->getIdSite(), 'element_site' => $this->getElementSite(), 'description_site' => $this->getDescriptionSite()];
    }
}
