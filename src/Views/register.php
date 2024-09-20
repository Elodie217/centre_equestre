<?php

include __DIR__ . '/Includes/headerWebsite.php';

?>

<section class="sectionRegister">

    <div class="divRegister">
        <h1 class="font-bold" style='font-family: "Amatic SC", sans-serif;'>Inscription</h1>
        <div class='divform'>
            <label for="loginRegister" class='labelRegister'>Votre identifiant* :</label>
            <div class="passwordSpan mb-2">Votre identifiant est indiqué dans le mail que vous avez reçu.</div>
            <input type="text" name="loginRegister" id="loginRegister" class="inputRegister">

            <div id="errorMessageRegister" class="text-[#ff2727]"></div>

            <div class="divbutton">
                <button type="button" class="btnRegister" onclick='registerVerification(<?= $idNewUser ?>)'>Valider</button>
            </div>
        </div>
    </div>

    <input type="hidden" id="<?= $idNewUser ?>" class="idNewUser">

</section>

<?php
include __DIR__ . '/Includes/footerWebsite.php'
?>