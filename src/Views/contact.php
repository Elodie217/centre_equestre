<?php
require_once __DIR__ . '/Includes/Button.php';

$boutonSend = new Button('Envoyer', 'sendContactVerification()');

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarre.php';

?>
<section class="bg-[url('https://images.unsplash.com/photo-1589824493580-eacaf31c2a82?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] h-full bg-cover bg-center -mt-10">

    <h1 class="text-8xl text-center py-48 w-2/3 m-auto font-bold" style='font-family: "Amatic SC", sans-serif;'>Contact</h1>

</section>
<section class="md:flex justify-around my-10 flex-wrap sm:flex-nowrap ">
    <div class="w-fit mx-auto p-8 md:mx-4">
        <p class="m-4">Venez nous voir !</p>
        <div class="m-4"><span class="font-bold">Adresse :</span>
            <p href="">123 route Victor Hugo, <br>
                38000 Grenoble
            </p>
        </div>
        <div class="m-4">
            <span class="font-bold">Téléphone : </span><a href=" tel:0612345678">06 12 34 56 78</a>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5624.191481126517!2d5.734539475384973!3d45.18515815201494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478af4f18a622bcd%3A0x9248f4aa2b46d942!2sQuartier%20Exposition-Bajati%C3%A8re%2C%2038100%20Grenoble!5e0!3m2!1sfr!2sfr!4v1719409422080!5m2!1sfr!2sfr" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="w-fit max-w-[500px] mx-auto p-8 md:mx-4 bg-[#C0DF85] rounded-lg">
        <h3 class="text-center text-3xl m-4 mb-6">Contactez-nous</h3>
        <div class="flex sm:space-x-4">
            <input type="text" id="lastnameContact" class="w-full border-b-2 border-gray-900 placeholder-black bg-[#C0DF85] m-4" placeholder="Nom*">
            <input type="text" id="firstnameContact" class="w-full border-b-2 border-gray-900 placeholder-black bg-[#C0DF85] m-4" placeholder="Prénom*">
        </div>

        <input type="email" id="emailContact" class="w-full border-b-2 border-gray-900 placeholder-black bg-[#C0DF85] m-4" placeholder="Email*">
        <textarea name="message" id="messageContact" class="border-b-2 border-gray-900 placeholder-black bg-[#C0DF85] m-4 w-full h-40" placeholder="Votre message ..."></textarea>

        <div id="errorMessageContact"></div>


        <div class="w-fit text-2xl m-auto mt-8">
            <?= $boutonSend->create_btn() ?>
        </div>
    </div>

</section>



<?php
include __DIR__ . '/Includes/footer.php'
?>