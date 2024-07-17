<?php

namespace src\Controllers;

use src\Repositories\UserRepository;
use src\Services\Reponse;

class UserController
{
    public function allUser()
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->getAllUser();
        return json_encode($reponse);
    }

    public function userLoginVerification($idNewUser, $loginUser)
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->userLoginVerification($idNewUser, $loginUser);
        return json_encode($reponse);
    }

    public function userById($idUser)
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->getUserById($idUser);
        return json_encode($reponse);
    }


    public function registration($idUser, $loginUser, $lastnameUserRegister, $firstnameUserRegister, $emailUserRegister, $phoneUserRegister, $birthdateUserRegister, $addressUserRegister, $passwordRegister, $passwordRegisterBis)
    {

        if (isset($lastnameUserRegister) && !empty($lastnameUserRegister) && isset($firstnameUserRegister) && !empty($firstnameUserRegister) && isset($emailUserRegister) && !empty($emailUserRegister) && isset($passwordRegister) && !empty($passwordRegister)) {
            if (
                strlen($lastnameUserRegister) <= 50 &&
                strlen($lastnameUserRegister) <= 50
            ) {
                $lastnameUserRegister = htmlspecialchars($lastnameUserRegister);
                $firstnameUserRegister = htmlspecialchars($firstnameUserRegister);

                if (filter_var($emailUserRegister, FILTER_VALIDATE_EMAIL)) {
                    $emailUserRegister = htmlspecialchars($emailUserRegister);
                    if (preg_match('/^[0-9]{10}+$/', $phoneUserRegister) || $phoneUserRegister == '') {
                        if ($phoneUserRegister == '') {
                            $phoneUserRegister = NULL;
                        } else {
                            $phoneUserRegister = htmlspecialchars($phoneUserRegister);
                        }

                        if (
                            strlen($addressUserRegister) <= 255
                        ) {
                            if ($addressUserRegister == '') {
                                $addressUserRegister = NULL;
                            } else {
                                $addressUserRegister = htmlspecialchars($addressUserRegister);
                            }

                            if ($passwordRegister == $passwordRegisterBis) {

                                if (strlen($passwordRegister) >= 6) {


                                    if ($birthdateUserRegister !== '') {
                                        list($year, $month, $day) = explode("-", $birthdateUserRegister);
                                        if (checkdate($month, $day, $year)) {
                                            $birthdateUserRegister = htmlspecialchars($birthdateUserRegister);
                                        } else {
                                            $response = array(
                                                'status' => 'error',
                                                'message' => 'Merci de renter une date valide.'
                                            );
                                            return json_encode($response);
                                            die;
                                        }
                                    } else if ($birthdateUserRegister == '') {

                                        $birthdateUserRegister = NULL;
                                    } else {
                                        $response = array(
                                            'status' => 'error',
                                            'message' => 'Merci de renter une date valide.'
                                        );
                                        return json_encode($response);
                                        die;
                                    }

                                    $UserRepository = new UserRepository;
                                    $reponse = $UserRepository->registration($idUser, $loginUser, $lastnameUserRegister, $firstnameUserRegister, $emailUserRegister, $phoneUserRegister, $birthdateUserRegister, $addressUserRegister, $passwordRegister);
                                    return json_encode($reponse);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'Le mot de passe doit faire au minimum 6 caractères.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Les mots de passe doivent être identiques.'
                                );
                                return json_encode($response);
                                die;
                            }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'L\'adresse doit faire au maximum 255 caractères.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Merci de rentrer un numéro de téléphone valide.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Merci de rentrer un email valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom et le prénom doivent faire au maximum 50 caractères.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs avec une *.'
            );
            return json_encode($response);
            die;
        }
    }

    public function emailForgetPassword($emailForgetPassword)
    {
        if (isset($emailForgetPassword) && !empty($emailForgetPassword)) {

            if (filter_var($emailForgetPassword, FILTER_VALIDATE_EMAIL)) {
                $emailForgetPassword = htmlspecialchars($emailForgetPassword);

                $UserRepository = new UserRepository;
                $reponse = $UserRepository->sendEmailForgetPassword($emailForgetPassword);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de rentrer un email valide.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de rentrer votre email.'
            );
            return json_encode($response);
            die;
        }
    }

    public function change($idUser, $loginUser, $passwordForgotPasswordUser, $passwordbisForgotPasswordUser)
    {

        if (isset($passwordForgotPasswordUser) && !empty($passwordForgotPasswordUser) && isset($passwordbisForgotPasswordUser) && !empty($passwordbisForgotPasswordUser)) {

            if ($passwordForgotPasswordUser == $passwordbisForgotPasswordUser) {

                if (strlen($passwordForgotPasswordUser) >= 6) {

                    $UserRepository = new UserRepository;
                    $reponse = $UserRepository->change($idUser, $loginUser, $passwordForgotPasswordUser);
                    return json_encode($reponse);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Le mot de passe doit faire au minimum 6 caractères.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Les mots de passe doivent être identiques.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs avec une *.'
            );
            return json_encode($response);
            die;
        }
    }

    function addUser($lastnameUserAdd, $firstnameUserAdd, $emailUserAdd, $phoneUserAdd, $birthdateUserAdd, $addressUserAdd, $roleUserAdd, $levelUserAdd)
    {

        if (isset($lastnameUserAdd) && !empty($lastnameUserAdd) && isset($firstnameUserAdd) && !empty($firstnameUserAdd) && isset($emailUserAdd) && !empty($emailUserAdd) && isset($roleUserAdd) && !empty($roleUserAdd)) {
            if (
                strlen($lastnameUserAdd) <= 50 &&
                strlen($lastnameUserAdd) <= 50
            ) {
                $lastnameUserAdd = htmlspecialchars($lastnameUserAdd);
                $firstnameUserAdd = htmlspecialchars($firstnameUserAdd);

                if (filter_var($emailUserAdd, FILTER_VALIDATE_EMAIL)) {
                    $emailUserAdd = htmlspecialchars($emailUserAdd);
                    if (preg_match('/^[0-9]{10}+$/', $phoneUserAdd) || $phoneUserAdd == '') {
                        if ($phoneUserAdd == '') {
                            $phoneUserAdd = NULL;
                        } else {
                            $phoneUserAdd = htmlspecialchars($phoneUserAdd);
                        }


                        if (
                            strlen($addressUserAdd) <= 255
                        ) {
                            if ($addressUserAdd == '') {
                                $addressUserAdd = NULL;
                            } else {
                                $addressUserAdd = htmlspecialchars($addressUserAdd);
                            }

                            if (
                                $roleUserAdd == 'Admin' || $roleUserAdd == 'User'
                            ) {
                                $roleUserAdd = htmlspecialchars($roleUserAdd);

                                if (is_int((int)$levelUserAdd) || $levelUserAdd == '') {
                                    if ($levelUserAdd == '') {
                                        $levelUserAdd = NULL;
                                    } else {
                                        $levelUserAdd = htmlspecialchars($levelUserAdd);
                                    }


                                    if ($birthdateUserAdd !== '') {
                                        list($year, $month, $day) = explode("-", $birthdateUserAdd);
                                        if (checkdate($month, $day, $year)) {
                                            $birthdateUserAdd = htmlspecialchars($birthdateUserAdd);
                                        } else {
                                            $response = array(
                                                'status' => 'error',
                                                'message' => 'Merci de renter une date valide.'
                                            );
                                            return json_encode($response);
                                            die;
                                        }
                                    } else if ($birthdateUserAdd == '') {

                                        $birthdateUserAdd = NULL;
                                    } else {
                                        $response = array(
                                            'status' => 'error',
                                            'message' => 'Merci de renter une date valide.'
                                        );
                                        return json_encode($response);
                                        die;
                                    }

                                    $UserRepository = new UserRepository;
                                    $reponse = $UserRepository->addUser($lastnameUserAdd, $firstnameUserAdd, $emailUserAdd, $phoneUserAdd, $birthdateUserAdd, $addressUserAdd, $roleUserAdd, $levelUserAdd);
                                    return json_encode($reponse);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'Merci de selectionner un niveau.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Merci de séléctionner un role.'
                                );
                                return json_encode($response);
                                die;
                            }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'L\'adresse doit faire au maximum 255 caractères.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Merci de rentrer un numéro de téléphone valide.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Merci de rentrer un email valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom et le prénom doivent faire au maximum 50 caractères.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs avec une *.'
            );
            return json_encode($response);
            die;
        }
    }


    function editUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit, $roleUserEdit, $levelUserEdit)
    {

        if (isset($lastnameUserEdit) && !empty($lastnameUserEdit) && isset($firstnameUserEdit) && !empty($firstnameUserEdit) && isset($emailUserEdit) && !empty($emailUserEdit) && isset($roleUserEdit) && !empty($roleUserEdit)) {
            if (
                strlen($lastnameUserEdit) <= 50 &&
                strlen($lastnameUserEdit) <= 50
            ) {
                $lastnameUserEdit = htmlspecialchars($lastnameUserEdit);
                $firstnameUserEdit = htmlspecialchars($firstnameUserEdit);

                if (filter_var($emailUserEdit, FILTER_VALIDATE_EMAIL)) {
                    $emailUserEdit = htmlspecialchars($emailUserEdit);
                    if (preg_match('/^[0-9]{10}+$/', $phoneUserEdit) || $phoneUserEdit == '') {
                        if ($phoneUserEdit == '') {
                            $phoneUserEdit = NULL;
                        } else {
                            $phoneUserEdit = htmlspecialchars($phoneUserEdit);
                        }

                        if (
                            strlen($addressUserEdit) <= 255
                        ) {
                            if ($addressUserEdit == '') {
                                $addressUserEdit = NULL;
                            } else {
                                $addressUserEdit = htmlspecialchars($addressUserEdit);
                            }

                            if (
                                $roleUserEdit == 'Admin' || $roleUserEdit == 'User'
                            ) {
                                $roleUserEdit = htmlspecialchars($roleUserEdit);

                                if (is_int($levelUserEdit) || $levelUserEdit == '') {
                                    if ($levelUserEdit == '') {
                                        $levelUserEdit = NULL;
                                    } else {
                                        $levelUserEdit = htmlspecialchars($levelUserEdit);
                                    }


                                    if ($birthdateUserEdit !== '') {
                                        list($year, $month, $day) = explode("-", $birthdateUserEdit);
                                        if (checkdate($month, $day, $year)) {
                                            $birthdateUserEdit = htmlspecialchars($birthdateUserEdit);
                                        } else {
                                            $response = array(
                                                'status' => 'error',
                                                'message' => 'Merci de renter une date valide.'
                                            );
                                            return json_encode($response);
                                            die;
                                        }
                                    } else if ($birthdateUserEdit == '') {

                                        $birthdateUserEdit = NULL;
                                    } else {
                                        $response = array(
                                            'status' => 'error',
                                            'message' => 'Merci de renter une date valide.'
                                        );
                                        return json_encode($response);
                                        die;
                                    }

                                    $UserRepository = new UserRepository;
                                    $reponse = $UserRepository->editUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit, $roleUserEdit, $levelUserEdit);
                                    return json_encode($reponse);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'Merci de selectionner un niveau.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Merci de séléctionner un role.'
                                );
                                return json_encode($response);
                                die;
                            }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'L\'adresse doit faire au maximum 255 caractères.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Merci de rentrer un numéro de téléphone valide.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Merci de rentrer un email valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom et le prénom doivent faire au maximum 50 caractères.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs avec une *.'
            );
            return json_encode($response);
            die;
        }
    }

    function editProfileUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit)
    {

        if (isset($lastnameUserEdit) && !empty($lastnameUserEdit) && isset($firstnameUserEdit) && !empty($firstnameUserEdit) && isset($emailUserEdit) && !empty($emailUserEdit)) {
            if (
                strlen($lastnameUserEdit) <= 50 &&
                strlen($lastnameUserEdit) <= 50
            ) {
                $lastnameUserEdit = htmlspecialchars($lastnameUserEdit);
                $firstnameUserEdit = htmlspecialchars($firstnameUserEdit);

                if (filter_var($emailUserEdit, FILTER_VALIDATE_EMAIL)) {
                    $emailUserEdit = htmlspecialchars($emailUserEdit);
                    if (preg_match('/^[0-9]{10}+$/', $phoneUserEdit) || $phoneUserEdit == '') {
                        if ($phoneUserEdit == '') {
                            $phoneUserEdit = NULL;
                        } else {
                            $phoneUserEdit = htmlspecialchars($phoneUserEdit);
                        }

                        if (
                            strlen($addressUserEdit) <= 255
                        ) {
                            if ($addressUserEdit == '') {
                                $addressUserEdit = NULL;
                            } else {
                                $addressUserEdit = htmlspecialchars($addressUserEdit);
                            }

                            // if (
                            //     $roleUserEdit == 'Admin' || $roleUserEdit == 'User'
                            // ) {
                            //     $roleUserEdit = htmlspecialchars($roleUserEdit);

                            //     if (is_int($levelUserEdit) || $levelUserEdit == '') {
                            //         if ($levelUserEdit == '') {
                            //             $levelUserEdit = NULL;
                            //         } else {
                            //             $levelUserEdit = htmlspecialchars($levelUserEdit);
                            //         }


                            if ($birthdateUserEdit !== '') {
                                list($year, $month, $day) = explode("-", $birthdateUserEdit);
                                if (checkdate($month, $day, $year)) {
                                    $birthdateUserEdit = htmlspecialchars($birthdateUserEdit);
                                } else {
                                    $response = array(
                                        'status' => 'error',
                                        'message' => 'Merci de renter une date valide.'
                                    );
                                    return json_encode($response);
                                    die;
                                }
                            } else if ($birthdateUserEdit == '') {

                                $birthdateUserEdit = NULL;
                            } else {
                                $response = array(
                                    'status' => 'error',
                                    'message' => 'Merci de renter une date valide.'
                                );
                                return json_encode($response);
                                die;
                            }

                            $UserRepository = new UserRepository;
                            $reponse = $UserRepository->editProfileUser($idUserEdit, $lastnameUserEdit, $firstnameUserEdit, $emailUserEdit, $phoneUserEdit, $birthdateUserEdit, $addressUserEdit);
                            return json_encode($reponse);
                            //     } else {
                            //         $response = array(
                            //             'status' => 'error',
                            //             'message' => 'Merci de selectionner un niveau.'
                            //         );
                            //         return json_encode($response);
                            //         die;
                            //     }
                            // } else {
                            //     $response = array(
                            //         'status' => 'error',
                            //         'message' => 'Merci de séléctionner un role.'
                            //     );
                            //     return json_encode($response);
                            //     die;
                            // }
                        } else {
                            $response = array(
                                'status' => 'error',
                                'message' => 'L\'adresse doit faire au maximum 255 caractères.'
                            );
                            return json_encode($response);
                            die;
                        }
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Merci de rentrer un numéro de téléphone valide.'
                        );
                        return json_encode($response);
                        die;
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Merci de rentrer un email valide.'
                    );
                    return json_encode($response);
                    die;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Le nom et le prénom doivent faire au maximum 50 caractères.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs avec une *.'
            );
            return json_encode($response);
            die;
        }
    }


    function disableUser($idUser)
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->disableUser($idUser);
        return json_encode($reponse);
    }

    function deleteUser($idUser)
    {
        $UserRepository = new UserRepository;
        $reponse = $UserRepository->deleteUser($idUser);
        return json_encode($reponse);
    }
}
