<?php

namespace src\Models;

class Boarding
{
    private $id_boarding;
    private $name_boarding;
    private $price_boarding;
    private $service_boarding;
    private $service2_boarding;


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

    /**
     * Get the value of price_boarding
     */
    public function getPriceBoarding()
    {
        return $this->price_boarding;
    }

    /**
     * Set the value of price_boarding
     */
    public function setPriceBoarding($price_boarding): self
    {
        $this->price_boarding = $price_boarding;

        return $this;
    }

    /**
     * Get the value of service_boarding
     */
    public function getServiceBoarding()
    {
        return $this->service_boarding;
    }

    /**
     * Set the value of service_boarding
     */
    public function setServiceBoarding($service_boarding): self
    {
        $this->service_boarding = $service_boarding;

        return $this;
    }

    /**
     * Get the value of service2_boarding
     */
    public function getService2Boarding()
    {
        return $this->service2_boarding;
    }

    /**
     * Set the value of service2_boarding
     */
    public function setService2Boarding($service2_boarding): self
    {
        $this->service2_boarding = $service2_boarding;

        return $this;
    }


    public function getObjectToArray(): array
    {
        return ['id_boarding' => $this->getIdBoarding(), 'name_boarding' => $this->getNameBoarding(), 'price_boarding' => $this->getPriceBoarding(), 'service_boarding' => $this->getServiceBoarding(), 'service2_boarding' => $this->getService2Boarding()];
    }
}
