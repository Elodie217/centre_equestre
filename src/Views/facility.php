<?php
require_once __DIR__ . '/Includes/Button.php';

$boutonSend = new Button('Envoyer', 'sendContactVerification()');

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>
<section class="bg-[url('https://images.unsplash.com/photo-1664770427715-f1de5e31d21f?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class="text-6xl sm:text-8xl text-center py-48 w-2/3 m-auto font-bold textShadow" style='font-family: "Amatic SC", sans-serif;'>Les installations</h1>

</section>
<section>
    <section class="m-10 md:flex md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">Les prés</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Nos vastes prés permettent à vos chevaux de profiter de moments de liberté en toute sérénité. Entourés de clôtures sécurisées, ils offrent des espaces verts pour le bien-être et la détente des chevaux.</div>

        </div>
        <img src="https://images.unsplash.com/photo-1624668430995-1a1d054227ae?q=80&w=1469&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="md:w-1/2 sm:p-6">
    </section>

    <section class="m-10 md:flex md:flex-row-reverse md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">Les box</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Nos box spacieux et confortables offrent un espace sécurisé pour le bien-être de vos chevaux. Chacun est équipé d'un abreuvoir automatique et d'une litière régulièrement renouvelée pour assurer propreté et confort.</div>
        </div>
        <img src="https://cdn.pixabay.com/photo/2021/11/03/18/25/construction-6766555_1280.jpg" alt="" class="md:w-1/2 sm:p-6">
    </section>

    <section class="m-10 md:flex md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">La carrière</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Notre carrière extérieure est idéale pour les entraînements et les compétitions. Avec un sol de qualité, parfaitement entretenu, elle permet de travailler en toute sécurité, quelles que soient les conditions climatiques.</div>
        </div>
        <img src="https://images.unsplash.com/photo-1606001629444-e3625ffa4010?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="md:w-1/2 sm:p-6">
    </section>

    <section class="m-10 md:flex md:flex-row-reverse md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">Le manège</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Le manège couvert est parfait pour les entraînements en toutes saisons. Spacieux et lumineux, il offre des conditions optimales pour travailler avec les chevaux, même en cas de mauvais temps.</div>
        </div>
        <img src="https://img.freepik.com/photos-gratuite/fille-elegante-dans-ferme-cheval_1157-38110.jpg?t=st=1725521299~exp=1725524899~hmac=82ff4aaebd570b46a5d8a195fb16c441c0aeaff9d8ff11b9ad0052817802624c&w=740" alt="" class="md:w-1/2 sm:p-6">
    </section>

    <section class="m-10 md:flex md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">La sellerie</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Notre sellerie est parfaitement équipée pour stocker en toute sécurité votre matériel. Spacieuse et bien organisée, elle permet de garder votre équipement en parfait état et toujours à portée de main.</div>

        </div>
        <img src="https://images.unsplash.com/photo-1497624138727-ebc770ef361e?q=80&w=1469&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="md:w-1/2 sm:p-6">
    </section>

    <section class="m-10 md:flex md:flex-row-reverse md:justify-around md:items-center ">
        <div class="md:w-1/2 md:mx-2 lg:mx-4">
            <h2 class="text-3xl">Le club house</h2>
            <div class="px-2 py-4 sm:p-6 text-justify">Notre club house chaleureux est l'endroit idéal pour se détendre après une séance d'équitation. Profitez d’un espace convivial pour échanger entre cavaliers, autour d'un café ou d'une collation.</div>
        </div>
        <img src="https://images.unsplash.com/photo-1676661647337-1036036e1d5e?q=80&w=1466&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="md:w-1/2 sm:p-6">
    </section>

</section>



<?php
include __DIR__ . '/Includes/footer.php'
?>