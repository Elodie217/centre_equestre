<?php

namespace src\Models;

class Lesson
{
    private $id_lesson;
    private $title_lesson;
    private $date_lesson;
    private $places_lesson;
    private $name_level;
    private $all_name_levels;
    private $all_names_user;
    private $id_user;




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
     * Get the value of title_lesson
     */
    public function getTitleLesson()
    {
        return $this->title_lesson;
    }

    /**
     * Set the value of title_lesson
     */
    public function setTitleLesson($title_lesson): self
    {
        $this->title_lesson = $title_lesson;

        return $this;
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
     * Get the value of all_name_levels
     */
    public function getAllNameLevels()
    {
        return $this->all_name_levels;
    }

    /**
     * Set the value of all_name_levels
     */
    public function setAllNameLevels($all_name_levels): self
    {
        $this->all_name_levels = $all_name_levels;

        return $this;
    }

    /**
     * Get the value of all_names_user
     */
    public function getAllNamesUser()
    {
        return $this->all_names_user;
    }

    /**
     * Set the value of all_names_user
     */
    public function setAllNamesUser($all_names_user): self
    {
        $this->all_names_user = $all_names_user;

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

    public function getObjectToArray(): array
    {
        return ['id_lesson' => $this->getIdLesson(), 'title_lesson' => $this->getTitleLesson(), 'date_lesson' => $this->getDateLesson(), 'places_lesson' => $this->getPlacesLesson(), 'name_level' => $this->getNameLevel(), 'all_name_levels' => $this->getAllNameLevels(), 'all_names_user' => $this->getAllNamesUser(), 'id_user' => $this->getIdUser()];
    }
}
