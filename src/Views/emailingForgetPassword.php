<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="sectionLogin">
    <div class="divLogin">
        <div class="divImg">
            <h1 class="">Réinitialisation de votre mot de passe</h1>
        </div>
        <div>
            <div class="formDiv">
                <p class="italic mb-4 text-base">Veuillez entrer l'adresse e-mail associée à votre compte. <br>
                    Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

                <label for="emailForgetPassword" class="">Votre e-mail :</label>
                <input class="" type="text" name="emailForgetPassword" id="emailForgetPassword" />
            </div>


            <div id="errorMessageEmailingForgetPassword" class="text-[#ff2727]"></div>

            <div class="mt-8 flex justify-center text-lg text-black">
                <button type="submit" class="btnLoginForm" onclick="emailingForgetPassword()">Envoyer</button>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/Includes/footer.php'
?>