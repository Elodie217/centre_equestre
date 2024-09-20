<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="sectionLogin">
    <div class="divLogin">
        <div class="divImg">
            <img src="/public/assets/images/logoText-removebg.png" alt="Logo des cavaliers des vallées" />
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
            <button onclick="pageEmailingForgetPassword()" class="linkPassword">Mot de passe oublié ?</button>

            <div id="errorMessageLogin" class="text-[#ff2727]"></div>

            <div class="mt-8 flex justify-center text-lg text-black">
                <button type="submit" class="btnLoginForm" onclick="loginVerification()">Connexion</button>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/Includes/footer.php'
?>