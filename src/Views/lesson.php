<?php
require_once __DIR__ . '/Includes/Button.php';

$boutonSend = new Button('Envoyer', 'sendContactVerification()');

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>
<section class="bg-[url('https://images.pexels.com/photos/1364073/pexels-photo-1364073.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] h-full bg-cover bg-center -mt-10">

    <h1 class="text-8xl text-center py-48 w-2/3 m-auto font-bold textShadow" style='font-family: "Amatic SC", sans-serif;'>Les cours</h1>

</section>
<section>
    <section class="m-10">
        <h2 class="text-3xl">Présentation</h2>
        <div class="lg:flex justify-around items-center">
            <div class="lg:w-1/2 p-2 sm:p-6 text-justify">Au Centre Équestre Les Cavaliers des Vallées, nous offrons une gamme complète de cours pour tous les âges et niveaux. De l'initiation à l'équitation pour les débutants aux cours de perfectionnement pour les cavaliers confirmés, nous proposons également des leçons spécialisées comme le saut d'obstacles, le dressage et le cross. Nos stage de balades, de voltige, pony games, et éthologie éveillent la curiosité et renforcent la complicité avec votre cheval. Tous nos cours sont encadrés par des moniteurs qualifiés, qui sauront vous accompagner avec passion et professionnalisme. Rejoignez-nous et vivez pleinement votre passion au rythme des chevaux !</div>
            <img src="https://images.pexels.com/photos/103543/pexels-photo-103543.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="lg:w-1/2 p-2 sm:p-6">
        </div>
    </section>
    <section class="m-10">
        <h2 class="text-3xl">Planning</h2>

    </section>

    <section class="m-10">
        <h2 class="text-3xl">Tarif</h2>

    </section>
</section>



<?php
include __DIR__ . '/Includes/footer.php'
?>