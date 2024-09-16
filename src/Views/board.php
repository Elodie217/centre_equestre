<?php
require_once __DIR__ . '/Includes/Button.php';

$boutonContact = new Button('Nous contacter', "redirect('contact')");

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="bg-[url('https://images.unsplash.com/photo-1689897319489-90486828911f?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class="text-8xl text-center py-48 w-2/3 m-auto font-bold textShadow" style='font-family: "Amatic SC", sans-serif;'>Pensions</h1>
</section>

<section class="m-5 sm:m-10">
    <h2 class="text-3xl">Présentation</h2>
    <div class="p-6 text-justify">
        Bienvenue dans notre espace dédié aux pensions équestres, où nous vous invitons à découvrir les différentes options que nous offrons pour le bien-être de votre cheval. Au centre équestre Les Cavaliers des Vallées, nous comprenons que chaque cheval est unique et mérite des soins adaptés à ses besoins spécifiques. C'est pourquoi nous proposons une variété de formules de pension, allant de la pension complète avec box et paddock, à la pension au pré, en passant par des services personnalisés pour répondre aux attentes de chaque propriétaire.
        <br><br>
        Nos installations modernes, situées en plein cœur de la Haute-Savoie, garantissent un environnement sécurisé et confortable pour votre compagnon. Notre équipe expérimentée veille quotidiennement à la santé, au confort et à l'épanouissement des chevaux, en leur offrant des soins attentifs et un cadre de vie optimal. Explorez nos options de pension pour trouver celle qui correspond le mieux à vos attentes et à celles de votre cheval.
    </div>
</section>

<section class="m-5 sm:m-10">
    <h3 class="text-3xl">Choisissez l'offre de pension qu'il vous faut</h3>
    <div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10 mx-2 sm:mx-6 my-16 py-4'>
        <div class='text-center shadow-xl rounded-lg'>
            <h4 class='text-3xl text-[#64832F]'>Pension de base</h4>
            <div class="grid grid-cols-3 grid-rows-2 w-fit mx-auto mt-10">
                <div class='text-6xl col-span-2 text-right'>630</div>
                <div class='text-5xl text-left col-start-3'>€</div>
                <div class="text-sm col-start-2 row-start-2 text-right">par mois</div>
            </div>
            <p><i class="text-[#64832F] fa-solid fa-check"></i> Droit d' accès à toutes nos installations</p>
            <div class="w-fit text-2xl m-auto my-10">
                <?= $boutonContact->create_btn() ?>
            </div>
        </div>
        <div class='text-center shadow-xl rounded-lg'>
            <h4 class='text-3xl text-[#64832F]'>Pension de base</h4>
            <div class="grid grid-cols-3 grid-rows-2 w-fit mx-auto mt-10">
                <div class='text-6xl col-span-2 text-right'>740</div>
                <div class='text-5xl text-left col-start-3'>€</div>
                <div class="text-sm col-start-2 row-start-2 text-right">par mois</div>
            </div>
            <p><i class="text-[#64832F] fa-solid fa-check"></i> Droit d'accès à toutes nos installations</p>
            <p><i class="text-[#64832F] fa-solid fa-check"></i> 2 cours collectifs par semaine</p>
            <div class="w-fit text-2xl m-auto my-10">
                <?= $boutonContact->create_btn() ?>
            </div>
        </div>
        <div class='text-center shadow-xl rounded-lg'>
            <h4 class='text-3xl text-[#64832F]'>Pension de base</h4>
            <div class="grid grid-cols-3 grid-rows-2 w-fit mx-auto mt-10">
                <div class='text-6xl col-span-2 text-right'>780</div>
                <div class='text-5xl text-left col-start-3'>€</div>
                <div class="text-sm col-start-2 row-start-2 text-right">par mois</div>
            </div>
            <p><i class="fa-solid fa-check text-[#64832F]"></i> Droit d'accès à toutes nos installations</p>
            <p><i class="fa-solid fa-check text-[#64832F]"></i> 3 cours collectifs par semaine</p>
            <div class="w-fit text-2xl m-auto my-10">
                <?= $boutonContact->create_btn() ?>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#C0DF85] m-8 sm:m-16 md:m-28 xl:flex">
    <div class="xl:w-1/2 p-10">
        <p class="text-2xl my-4">Une question ?</p>
        <p class="mx-4 my-6">Ecrivez-nous via le formulaire de contact et nous vous répondrons dans les meilleurs délais.</p>
        <p class="mx-4 my-6">Ou passez-nous un coup de fil !
        </p>
        <a href="tel:0612345678" class="my-2 mx-4">06 12 34 56 78</a>

        <div class="w-fit text-xl m-auto mt-10">
            <?= $boutonContact->create_btn() ?>
        </div>
    </div>
    <div class="xl:w-1/2 p-5 sm:p-10">
        <img src="https://images.unsplash.com/photo-1508343919546-4a5792fee935?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Une femme embrassant son cheval">
    </div>
</section>

<section></section>

<?php
include __DIR__ . '/Includes/footer.php'
?>