<?php
require_once __DIR__ . '/Includes/Button.php';

$bouton = new Button('Découvrir', '#');
$boutonContact = new Button('Nous contacter', '#');

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="sectionLogin">
    <div class="divLogin">
        <div class="divImg">
            <img src="https://www.logo.wine/a/logo/Instagram/Instagram-Glyph-Color-Logo.wine.svg" alt="logo" />
            <h1 class="">Connexion</h1>
        </div>
        <form action="#">
            <div class="formDiv">
                <label for="login" class="">Identifiant</label>
                <input class="" type="text" name="login" />
            </div>

            <div class="formDiv">
                <label for="passwordLogin" class="">Mot de passe</label>
                <input class="" type="Password" name="passwordLogin" placeholder="*********" />
            </div>
            <a href="#" class="linkPassword">Mot de passe oublié ?</a>

            <div class="mt-8 flex justify-center text-lg text-black">
                <button type="submit" class="btnLoginForm">Connexion</button>
            </div>
        </form>
    </div>
</section>

<?php
include __DIR__ . '/Includes/footer.php'
?>