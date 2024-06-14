<?php

namespace src\Models;

class Lesson
{
    private $id_lesson;
    private $date_lesson;
    private $places_lesson;
    private $price_lesson;

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
     * Get the value of id_lesson
     */
    public function getIdLesson()
    {
        return $this->id_lesson;
    }

    /**
     * Set the value of id_lesson
     */
    public function setIdLesson($id_lesson): self
    {
        $this->id_lesson = $id_lesson;

        return $this;
    }

    /**
     * Get the value of date_lesson
     */
    public function getDateLesson()
    {
        return $this->date_lesson;
    }

    /**
     * Set the value of date_lesson
     */
    public function setDateLesson($date_lesson): self
    {
        $this->date_lesson = $date_lesson;

        return $this;
    }

    /**
     * Get the value of places_lesson
     */
    public function getPlacesLesson()
    {
        return $this->places_lesson;
    }

    /**
     * Set the value of places_lesson
     */
    public function setPlacesLesson($places_lesson): self
    {
        $this->places_lesson = $places_lesson;

        return $this;
    }

    /**
     * Get the value of price_lesson
     */
    public function getPriceLesson()
    {
        return $this->price_lesson;
    }

    /**
     * Set the value of price_lesson
     */
    public function setPriceLesson($price_lesson): self
    {
        $this->price_lesson = $price_lesson;

        return $this;
    }



    public function getObjectToArray(): array
    {
        return ['id_lesson' => $this->getIdLesson(), 'date_lesson' => $this->getDateLesson(), 'places_lesson' => $this->getPlacesLesson(), 'price_lesson' => $this->getPriceLesson()];
    }
}
