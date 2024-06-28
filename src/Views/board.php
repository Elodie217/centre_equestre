<?php
require_once __DIR__ . '/Includes/Button.php';

$boutonContact = new Button('Nous contacter', "redirect('contact')");

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>

<section class="bg-[url('https://images.unsplash.com/photo-1689897319489-90486828911f?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class=" text-5xl text-center py-56 w-2/3 m-auto">Pensions</h1>
</section>

<section class="m-10">
    <h2 class="text-3xl">Présentation</h2>
    <div class="p-6 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, consequuntur doloremque! Nostrum rerum facere labore, velit quis voluptates exercitationem commodi assumenda doloremque dolore architecto quam minima dolores ipsa quidem aspernatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, nisi id quo nulla aperiam eum harum iure ipsa deleniti, at necessitatibus, repudiandae eaque error quidem dolores illo sit velit quibusdam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, explicabo quam veniam, eaque, sit ipsum voluptate deserunt molestias dignissimos quos non a nemo. Exercitationem distinctio beatae nobis dolore laboriosam perspiciatis! <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi non magnam necessitatibus odit laudantium quam reiciendis exercitationem quaerat fuga facilis. Aliquid dolore iste minus? Mollitia libero rem reprehenderit voluptatum ducimus.
    </div>
</section>

<section class="m-10">
    <h3 class="text-3xl">Choisissez l'offre de pension qu'il vous faut</h3>
    <div class='grid grid-cols-3 grid-rows-1 gap-10 mx-6 my-16 py-4'>
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

<section class="bg-[#C0DF85] m-28 flex">
    <div class="w-1/2 p-10">
        <p class="text-2xl my-4">Une question ?</p>
        <p class="mx-4 my-6">Ecrivez-nous via le formulaire de contact et nous vous répondrons dans les meilleurs délais.</p>
        <p class="mx-4 my-6">Ou passez-nous un coup de fil !
        </p>
        <a href="tel:0612345678" class="my-2 mx-4">06 12 34 56 78</a>

        <div class="w-fit text-xl m-auto mt-10">
            <?= $boutonContact->create_btn() ?>
        </div>
    </div>
    <div class="w-1/2 p-10">
        <img src="https://images.unsplash.com/photo-1508343919546-4a5792fee935?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Une femme embrassant son cheval">
    </div>
</section>

<section></section>

<?php
include __DIR__ . '/Includes/footer.php'
?>