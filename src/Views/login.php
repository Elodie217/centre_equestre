<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="sectionLogin">
    <div class="divLogin">
        <div class="divImg">
            <img src="https://www.logo.wine/a/logo/Instagram/Instagram-Glyph-Color-Logo.wine.svg" alt="logo" />
            <h1 class="">Connexion</h1>
        </div>
        <div>
            <div class="formDiv">
                <label for="login" class="">Identifiant</label>
                <input class="" type="text" name="login" id="login" />
            </div>

            <div class="formDiv">
                <label for="passwordLogin" class="">Mot de passe</label>
                <input class="" id="passwordLogin" type="Password" name="passwordLogin" placeholder="*********" />
            </div>
            <a href="#" class="linkPassword">Mot de passe oublié ?</a>

            <div id="errorMessageLogin"></div>

            <div class="mt-8 flex justify-center text-lg text-black">
                <button type="submit" class="btnLoginForm" onclick="loginVerification()">Connexion</button>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/Includes/footer.php'
?>