<?php ?>

<footer class="bg-[#64832F] p-8 pb-2 text-base text-white">
    <section class="md:flex items-center">
        <section class=':w-1/3 p-4'>
            <img src="/public/assets/images/logoText.png" alt="Logo du centre équestre Les cavaliers des vallées" class='w-fit max-h-56 m-auto'>
        </section>
        <section class="w-fit m-auto md:w-2/3">
            <div class="md:flex justify-around">

                <div class=" space-y-6 flex flex-col">
                    <a href="">123 route Victor Hugo, <br>
                        38000 Grenoble
                    </a>
                    <a href="tel:0612345678">06 12 34 56 78</a>
                </div>
                <div class="space-y-4 mt-5 md:mt-0 md:mr-20 flex flex-col">
                    <button onclick="redirect('privacypolicy')" class="">Politique de confidentialité</button> <br>
                    <button onclick="redirect('legalnotices')" class="">Mentions légales</button>
                </div>

            </div>
            <div class=" flex justify-around mt-12 w-full md:w-1/2 m-auto text-2xl md:pr-20">
                <a href="https://www.facebook.com/?locale=fr_FR">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://twitter.com/?lang=fr">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/?app=desktop&hl=fr">
                    <i class="fa-brands fa-youtube"></i>
                </a>

            </div>
        </section>
    </section>
    <p class="text-xs w-fit m-auto mt-5 mb-1">© 2024 Centre équestre – Tous droits réservés – Site réalisé par Moi</p>
</footer>

<?php
include __DIR__ . '/footerWebsite.php'
?>