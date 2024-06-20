<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Horse;
use src\Models\Lesson;

class LessonRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function getAllLessons()
    {

        $sql = "SELECT " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson, " . PREFIXE . "lesson.price_lesson, 
        GROUP_CONCAT(DISTINCT " . PREFIXE . "level.name_level ORDER BY " . PREFIXE . "level.name_level SEPARATOR ', ') as all_name_levels, 
        GROUP_CONCAT(DISTINCT CONCAT(" . PREFIXE . "user.id_user, ' ', " . PREFIXE . "user.lastname_user, ' ', " . PREFIXE . "user.firstname_user) SEPARATOR ', ') as all_names_user
            FROM " . PREFIXE . "lesson
            LEFT JOIN " . PREFIXE . "lesson_level ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "lesson_level.id_lesson
            LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "lesson_level.id_level = " . PREFIXE . "level.id_level
            LEFT JOIN " . PREFIXE . "user_lesson ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "user_lesson.id_lesson
            LEFT JOIN " . PREFIXE . "user ON " . PREFIXE . "user_lesson.id_user = " . PREFIXE . "user.id_user
            GROUP BY " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson, " . PREFIXE . "lesson.price_lesson
            ";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Lesson::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    // public function getHorsesById($idHorse)
    // {

    //     $sql = "SELECT " . PREFIXE . "horse.id_horse, " . PREFIXE . "horse.name_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "horse.image_horse, " . PREFIXE . "horse.birthdate_horse," . PREFIXE . "horse.id_box," . PREFIXE . "horse.id_user," . PREFIXE . "box.name_box, " . PREFIXE . "user.firstname_user, " . PREFIXE . "user.lastname_user FROM " . PREFIXE . "horse, " . PREFIXE . "user, " . PREFIXE . "box
    //     WHERE " . PREFIXE . "horse.id_user =  " . PREFIXE . "user.id_user
    //     AND " . PREFIXE . "horse.id_box =  " . PREFIXE . "box.id_box
    //     AND " . PREFIXE . "horse.id_horse = :id_horse";

    //     $statement = $this->db->prepare($sql);
    //     $statement->bindParam(':id_horse', $idHorse);

    //     $statement->execute();

    //     $statement->setFetchMode(PDO::FETCH_CLASS, Horse::class);
    //     $objet = $statement->fetch();

    //     $retour = $objet->getObjectToArray();

    //     return $retour;
    // }

    public function addLesson($dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd)
    {
        $date = $dateLessonAdd . ' ' . $hourLessonAdd;


        $sql = "INSERT INTO " . PREFIXE . "lesson (date_lesson, places_lesson) VALUES (:dateLessonAdd, :placeLessonAdd)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':dateLessonAdd', $date);
        $statement->bindParam(':placeLessonAdd', $placeLessonAdd);

        if ($statement->execute()) {

            $lastInsertedId = $this->db->lastInsertId();
            if (count($levelsLessonAdd) > 0) {
                foreach ($levelsLessonAdd as $level) {

                    $sql = "INSERT INTO " . PREFIXE . "lesson_level (id_lesson, id_level) VALUES (:idLesson, :levelsLessonAdd)";

                    $statement = $this->db->prepare($sql);
                    $statement->bindParam(':idLesson', $lastInsertedId);
                    $statement->bindParam(':levelsLessonAdd', $level);

                    if ($statement->execute()) {
                        $reponse = array(
                            'status' => 'success',
                            'message' => "Nouvelle leçon enregistrée !"
                        );
                    } else {
                        $reponse = array(
                            'status' => 'error',
                            'message' => "Une erreur est survenue."
                        );
                        return $reponse;
                    }
                }
            } else {
                $reponse = array(
                    'status' => 'success',
                    'message' => "Nouvelle leçon enregistrée !"
                );
            }

            if (count($usersLessonAdd) > 0) {
                foreach ($usersLessonAdd as $user) {

                    $sql = "INSERT INTO " . PREFIXE . "user_lesson (id_user, id_lesson) VALUES (:userLessonAdd, :idLesson)";

                    $statement = $this->db->prepare($sql);
                    $statement->bindParam(':idLesson', $lastInsertedId);
                    $statement->bindParam(':userLessonAdd', $user);

                    if ($statement->execute()) {
                        $reponse = array(
                            'status' => 'success',
                            'message' => "Nouvelle leçon enregistrée !"
                        );
                    } else {
                        $reponse = array(
                            'status' => 'error',
                            'message' => "Une erreur est survenue."
                        );
                        return $reponse;
                    }
                }
                return $reponse;
            } else {
                $reponse = array(
                    'status' => 'success',
                    'message' => "Nouvelle leçon enregistrée !"
                );
                return $reponse;
            }
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }


    public function editLesson($idLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit)
    {
        $date = $dateLessonEdit . ' ' . $hourLessonEdit;


        $sql = "UPDATE " . PREFIXE . "lesson SET date_lesson = :dateLessonEdit, places_lesson = :placeLessonEdit WHERE id_lesson = :idLessonEdit;
        DELETE FROM " . PREFIXE . "lesson_level WHERE id_lesson = :idLessonEdit;
        DELETE FROM " . PREFIXE . "user_lesson WHERE id_lesson = :idLessonEdit;";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':dateLessonEdit', $date);
        $statement->bindParam(':placeLessonEdit', $placeLessonEdit);
        $statement->bindParam(':idLessonEdit', $idLessonEdit);


        if ($statement->execute()) {

            if (count($levelsLessonEdit) > 0) {
                foreach ($levelsLessonEdit as $level) {

                    $sql = "INSERT INTO " . PREFIXE . "lesson_level (id_lesson, id_level) VALUES (:idLessonEdit, :levelsLessonEdit)";

                    $statement = $this->db->prepare($sql);
                    $statement->bindParam(':levelsLessonEdit', $level);
                    $statement->bindParam(':idLessonEdit', $idLessonEdit);


                    if ($statement->execute()) {
                        $reponse = array(
                            'status' => 'success',
                            'message' => "Leçon modifiée !"
                        );
                    } else {
                        $reponse = array(
                            'status' => 'error',
                            'message' => "Une erreur est survenue."
                        );
                        return $reponse;
                    }
                }
            } else {
                $reponse = array(
                    'status' => 'success',
                    'message' => "Leçon modifiée !"
                );
            }

            if (count($usersLessonEdit) > 0) {
                foreach ($usersLessonEdit as $user) {

                    $sql = "INSERT INTO " . PREFIXE . "user_lesson (id_user, id_lesson) VALUES (:userLessonEdit, :idLessonEdit)";

                    $statement = $this->db->prepare($sql);
                    $statement->bindParam(':idLessonEdit', $idLessonEdit);
                    $statement->bindParam(':userLessonEdit', $user);

                    if ($statement->execute()) {
                        $reponse = array(
                            'status' => 'success',
                            'message' => "Leçon modifiée !"
                        );
                    } else {
                        $reponse = array(
                            'status' => 'error',
                            'message' => "Une erreur est survenue."
                        );
                        return $reponse;
                    }
                }
                return $reponse;
            } else {
                $reponse = array(
                    'status' => 'success',
                    'message' => "Leçon modifiée !"
                );
                return $reponse;
            }
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }

    // public function editHorse($idHorse, $nameHorse, $imageHorse, $birthdateHorse, $horseUser, $horseBox)
    // {
    //     $sql = "UPDATE " . PREFIXE . "horse SET name_horse = :nameHorse, birthdate_horse = :birthdateHorse, image_horse = :imageHorse, id_user = :horseUser, id_box = :horseBox WHERE id_horse = :idHorse";

    //     $statement = $this->db->prepare($sql);
    //     $statement->bindParam(':idHorse', $idHorse);
    //     $statement->bindParam(':nameHorse', $nameHorse);
    //     $statement->bindParam(':imageHorse', $imageHorse);
    //     $statement->bindParam(':birthdateHorse', $birthdateHorse);
    //     $statement->bindParam(':horseUser', $horseUser);
    //     $statement->bindParam(':horseBox', $horseBox);

    //     if ($statement->execute()) {
    //         $reponse = array(
    //             'status' => 'success',
    //             'message' => $nameHorse . ' a bien été modifié !'
    //         );
    //         return $reponse;
    //     } else {
    //         $reponse = array(
    //             'status' => 'error',
    //             'message' => "Une erreur est survenue."
    //         );
    //         return $reponse;
    //     }
    // }

    public function deleteLesson($idLesson)
    {
        $sql = "DELETE FROM " . PREFIXE . "lesson_level WHERE id_lesson = :id_lesson;
                DELETE FROM " . PREFIXE . "user_lesson WHERE id_lesson = :id_lesson;
                DELETE FROM " . PREFIXE . "lesson WHERE id_lesson = :id_lesson";

        $statement = $this->db->prepare($sql);

        $statement->bindParam(':id_lesson', $idLesson);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Cours supprimé !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }
}
