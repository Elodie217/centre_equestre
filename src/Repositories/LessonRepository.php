<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Lesson;

class LessonRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    //User

    public function getAllLessonsByIdUser($idUser)
    {
        $sql = "SELECT " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson, " . PREFIXE . "user.id_user,
        GROUP_CONCAT(DISTINCT " . PREFIXE . "level.name_level ORDER BY " . PREFIXE . "level.name_level SEPARATOR ', ') as all_name_levels
            FROM " . PREFIXE . "lesson
            LEFT JOIN " . PREFIXE . "lesson_level ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "lesson_level.id_lesson
            LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "lesson_level.id_level = " . PREFIXE . "level.id_level
            LEFT JOIN " . PREFIXE . "user_lesson ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "user_lesson.id_lesson
            LEFT JOIN " . PREFIXE . "user ON " . PREFIXE . "user_lesson.id_user = " . PREFIXE . "user.id_user
            WHERE " . PREFIXE . "user_lesson.id_user =  :idUser
            GROUP BY " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson;
            ";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idUser', $idUser);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Lesson::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function getAllLessonsByIdLevelUser()
    {
        $idUser = $_SESSION['user']->getIdUser();
        $idLevelUser = $_SESSION['user']->getIdLevel();

        $sql = "SELECT " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson, 
        GROUP_CONCAT(DISTINCT " . PREFIXE . "level.name_level ORDER BY " . PREFIXE . "level.name_level SEPARATOR ', ') as all_name_levels, 
        GROUP_CONCAT(DISTINCT CONCAT(" . PREFIXE . "user.id_user, ' ', " . PREFIXE . "user.lastname_user, ' ', " . PREFIXE . "user.firstname_user) SEPARATOR ', ') as all_names_user
            FROM " . PREFIXE . "lesson
            LEFT JOIN " . PREFIXE . "lesson_level ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "lesson_level.id_lesson
            LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "lesson_level.id_level = " . PREFIXE . "level.id_level
            LEFT JOIN " . PREFIXE . "user_lesson ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "user_lesson.id_lesson
            LEFT JOIN " . PREFIXE . "user ON " . PREFIXE . "user_lesson.id_user = " . PREFIXE . "user.id_user
            WHERE " . PREFIXE . "lesson_level.id_level = :idLevelUser
            AND " . PREFIXE . "lesson.date_lesson > CURRENT_DATE
            AND " . PREFIXE . "lesson.id_lesson NOT IN (
                SELECT " . PREFIXE . "lesson.id_lesson
                FROM " . PREFIXE . "lesson
                JOIN " . PREFIXE . "user_lesson ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "user_lesson.id_lesson
                WHERE " . PREFIXE . "user_lesson.id_user = :idUser
            )
            GROUP BY " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson;
            ";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':idLevelUser', $idLevelUser);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Lesson::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function changeLessonUser($idNewLesson, $idOldLesson)
    {
        $idUser = $_SESSION['user']->getIdUser();

        $sql = "UPDATE " . PREFIXE . "user_lesson SET id_lesson = :idNewLesson 
                WHERE id_user = :idUser
                AND id_lesson = :idOldLesson";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idNewLesson', $idNewLesson);
        $statement->bindParam(':idOldLesson', $idOldLesson);
        $statement->bindParam(':idUser', $idUser);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => 'Le cours a bien été modifié !'
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }

    public function deleteLessonUser($idLesson)
    {

        $idUser = $_SESSION['user']->getIdUser();

        $sql = "DELETE FROM " . PREFIXE . "user_lesson WHERE id_lesson = :id_lesson AND id_user = :id_user;";

        $statement = $this->db->prepare($sql);

        $statement->bindParam(':id_lesson', $idLesson);
        $statement->bindParam(':id_user', $idUser);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Votre cours à bien été annulé !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }

    //Admin

    public function getAllLessons()
    {

        $sql = "SELECT " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson, 
        GROUP_CONCAT(DISTINCT " . PREFIXE . "level.name_level ORDER BY " . PREFIXE . "level.name_level SEPARATOR ', ') as all_name_levels, 
        GROUP_CONCAT(DISTINCT CONCAT(" . PREFIXE . "user.id_user, ' ', " . PREFIXE . "user.lastname_user, ' ', " . PREFIXE . "user.firstname_user) SEPARATOR ', ') as all_names_user
            FROM " . PREFIXE . "lesson
            LEFT JOIN " . PREFIXE . "lesson_level ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "lesson_level.id_lesson
            LEFT JOIN " . PREFIXE . "level ON " . PREFIXE . "lesson_level.id_level = " . PREFIXE . "level.id_level
            LEFT JOIN " . PREFIXE . "user_lesson ON " . PREFIXE . "lesson.id_lesson = " . PREFIXE . "user_lesson.id_lesson
            LEFT JOIN " . PREFIXE . "user ON " . PREFIXE . "user_lesson.id_user = " . PREFIXE . "user.id_user
            GROUP BY " . PREFIXE . "lesson.id_lesson, " . PREFIXE . "lesson.title_lesson, " . PREFIXE . "lesson.date_lesson, " . PREFIXE . "lesson.places_lesson
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

    public function addLesson($titleLessonAdd, $dateLessonAdd, $hourLessonAdd, $placeLessonAdd, $levelsLessonAdd, $usersLessonAdd)
    {
        $date = $dateLessonAdd . ' ' . $hourLessonAdd;


        $sql = "INSERT INTO " . PREFIXE . "lesson (title_lesson, date_lesson, places_lesson) VALUES (:titleLessonAdd,:dateLessonAdd, :placeLessonAdd)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':titleLessonAdd', $titleLessonAdd);
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


    public function editLesson($idLessonEdit, $titleLessonEdit, $dateLessonEdit, $hourLessonEdit, $placeLessonEdit, $levelsLessonEdit, $usersLessonEdit)
    {
        $date = $dateLessonEdit . ' ' . $hourLessonEdit;


        $sql = "UPDATE " . PREFIXE . "lesson SET title_lesson = :titleLessonEdit, date_lesson = :dateLessonEdit, places_lesson = :placeLessonEdit WHERE id_lesson = :idLessonEdit;
        DELETE FROM " . PREFIXE . "lesson_level WHERE id_lesson = :idLessonEdit;
        DELETE FROM " . PREFIXE . "user_lesson WHERE id_lesson = :idLessonEdit;";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':titleLessonEdit', $titleLessonEdit);
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
