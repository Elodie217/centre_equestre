<?php

include __DIR__ . '/Includes/headerWebsite.php';

?>

<section class="sectionRegister">

    <div class="divRegister">
        <h1 class="font-bold" style='font-family: "Amatic SC", sans-serif;'>Réinitialiser votre mot de passe</h1>
        <div class='divform'>
            <label for="loginForgotPassword" class='labelRegister'>Votre identifiant* :</label>
            <input type="text" name="loginForgotPassword" id="loginForgotPassword" class="inputRegister">

            <div id="errorMessageforgotPassword" class="text-[#ff2727]"></div>

            <div class="divbutton">
                <button type="button" class="btnRegister" onclick='forgotPasswordVerification(<?= $idUser ?>)'>Valider</button>
            </div>
        </div>
    </div>

    <input type="hidden" id="<?= $idUser ?>" class="idUser">

</section>

<?php
include __DIR__ . '/Includes/footerWebsite.php'
?>