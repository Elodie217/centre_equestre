<?php

$route = $_SERVER['REDIRECT_URL'];

?>

<nav class="relative flex flex-wrap items-center justify-between mb-10 py-2 bg-[#64832F]">
    <button onclick="redirect('')" class="flex items-center mx-2 px-6">
        <img src="/public/assets/images/logo.png" alt="Logo des cavaliers des vallées" class='max-w-24 ml-4 mr-6'>
        <h2 class="text-4xl hidden sm:block" style='font-family: "Amatic SC", sans-serif;'>Les cavaliers des vallées</h2>
    </button>

    <div class="xl:hidden text-4xl mr-4 pr-6 sm:px-6">
        <button onclick="openMenu()" class="btnOpenMenu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <button class="hidden btnCloseMenu" onclick="closeMenu()">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="btnsMenu z-20 bg-[#64832F] absolute xl:static top-28 hidden xl:flex justify-between items-end w-full xl:w-auto px-6">
        <ul class="flex-col xl:flex-row flex xl:space-x-12 mt-4 xl:mt-0 xl:text-base xl:font-medium items-center">
            <li>
                <button onclick="redirect('user/lessons')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                        if ($route == HOME_URL . 'user/lessons') {
                                                                                                                                                                                                                                            echo "xl:underline border-y";
                                                                                                                                                                                                                                        } ?>">Mes cours</button>
            </li>
            <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']->getNumberHorse() == 1) {
                echo '<li><button onclick="redirect(\'user/horses\')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0';
                if ($route == HOME_URL . 'user/horses') {
                    echo "xl:underline border-y";
                }
                echo '">Mon cheval</button></li>';
            } elseif (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']->getNumberHorse() > 1) {
                echo '<li><button onclick="redirect(\'user/horses\')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0';
                if ($route == HOME_URL . 'user/horses') {
                    echo "xl:underline border-y";
                }
                echo '">Mes chevaux</button></li>';
            } ?>
            <li>
                <button onclick="redirect('user/profile')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                        if ($route == HOME_URL . 'user/profile') {
                                                                                                                                                                                                                                            echo "xl:underline border-y";
                                                                                                                                                                                                                                        } ?>">Mon compte</button>
            </li>
            <li>
                <button onclick="logout()" class="text-white my-0.5 xl:m-0 hover:bg-[#A16C21] rounded-xl block pl-3 pr-4 py-2 xl:py-3 xl:px-5 mb-4 bg-[#895B1E]">Déconnexion</button>
            </li>
        </ul>
    </div>
</nav>