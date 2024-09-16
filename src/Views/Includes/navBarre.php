<?php

$route = $_SERVER['REDIRECT_URL'];

?>

<nav class="relative flex flex-wrap items-center justify-between mb-10 py-2 bg-[#64832F]">
    <a href="#" class="flex items-center mx-2 px-6">
        <img src="/public/assets/images/logo.png" alt="Logo des cavaliers des vallées" class='max-w-24 ml-4 mr-6'>
        <h2 class="text-4xl hidden sm:block" style='font-family: "Amatic SC", sans-serif;'>Les cavaliers des vallées</h2>
    </a>

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
                <button onclick="redirect('')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                            if ($route == HOME_URL . '') {
                                                                                                                                                                                                                                echo "xl:underline border-y";
                                                                                                                                                                                                                            } ?>">Accueil</button>
            </li>
            <li>
                <button onclick="redirect('lesson')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                    if ($route == HOME_URL . 'lesson') {
                                                                                                                                                                                                                                        echo "xl:underline border-y";
                                                                                                                                                                                                                                    }  ?>">Cours</button>
            </li>
            <li>
                <button onclick="redirect('facility')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                    if ($route == HOME_URL . 'facility') {
                                                                                                                                                                                                                                        echo "xl:underline border-y";
                                                                                                                                                                                                                                    } ?>">Installations</button>
            </li>
            <li>
                <button onclick="redirect('horses')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                    if ($route == HOME_URL . 'horses') {
                                                                                                                                                                                                                                        echo "xl:underline border-y";
                                                                                                                                                                                                                                    } ?>">Chevaux</button>
            </li>
            <li>
                <button onclick="redirect('board')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                    if ($route == HOME_URL . 'board') {
                                                                                                                                                                                                                                        echo "xl:underline border-y";
                                                                                                                                                                                                                                    } ?>">Pensions</button>
            </li>
            <li>
                <button onclick="redirect('contact')" class="text-white hover:border-y border-[#C0DF85] my-0.5 xl:m-0 xl:border-0 block pl-3 pr-4 py-2 xl:hover:border-0 xl:hover:underline underline-offset-8 decoration-2 xl:p-0 <?php
                                                                                                                                                                                                                                    if ($route == HOME_URL . 'contact') {
                                                                                                                                                                                                                                        echo "xl:underline border-y";
                                                                                                                                                                                                                                    } ?>">Contact</button>
            </li>
            <li>
                <button onclick="redirect('login')" class="text-white my-0.5 xl:m-0 hover:bg-[#A16C21] rounded-xl block pl-3 pr-4 py-2 xl:py-3 xl:px-5 mb-4 <?php if ($route == HOME_URL . 'login') {
                                                                                                                                                                echo "bg-[#A16C21]";
                                                                                                                                                            } else {
                                                                                                                                                                echo "bg-[#895B1E]";
                                                                                                                                                            } ?>">Connexion</button>
            </li>
        </ul>
    </div>
</nav>


<!-- <nav class="border-gray-200 mb-10 py-2 px-6 bg-[#64832F]">
    <div class="w-full mx-auto">
        <div class="mx-2 flex flex-wrap items-center justify-between">
            <a href="#" class="flex items-center">
                <img src="/public/assets/images/logo.png" alt="Logo des cavaliers des vallées" class='max-w-24 ml-4 mr-6'>
                <h2 class="text-4xl" style='font-family: "Amatic SC", sans-serif;'>Les cavaliers des vallées</h2>
            </a>
            <div class="flex md:hidden md:order-2">
                <button data-collapse-toggle="mobile-menu-3" type="button" class="md:hidden text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center" aria-controls="mobile-menu-3" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden md:flex justify-between items-end w-full md:w-auto md:order-1" id="mobile-menu-3">
                <ul class="flex-col md:flex-row flex md:space-x-12 mt-4 md:mt-0 md:text-base md:font-medium items-center">

                    <li>
                        <button onclick="redirect('')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                        if ($route == HOME_URL . '') {
                                                                                                                                                                                                                                            echo "md:underline";
                                                                                                                                                                                                                                        } ?>">Accueil</button>
                    </li>
                    <li>
                        <button onclick="redirect('lesson')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                            if ($route == HOME_URL . 'lesson') {
                                                                                                                                                                                                                                                echo "md:underline";
                                                                                                                                                                                                                                            }  ?>">Cours</button>
                    </li>
                    <li>
                        <button onclick="redirect('facility')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                                if ($route == HOME_URL . 'facility') {
                                                                                                                                                                                                                                                    echo "md:underline";
                                                                                                                                                                                                                                                } ?>">Installations</button>
                    </li>
                    <li>
                        <button onclick="redirect('horses')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                            if ($route == HOME_URL . 'horses') {
                                                                                                                                                                                                                                                echo "md:underline";
                                                                                                                                                                                                                                            } ?>">Chevaux</button>
                    </li>
                    <li>
                        <button onclick="redirect('board')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                            if ($route == HOME_URL . 'board') {
                                                                                                                                                                                                                                                echo "md:underline";
                                                                                                                                                                                                                                            } ?>">Pensions</button>
                    </li>
                    <li>
                        <button onclick="redirect('contact')" class="hover:bg-gray-50 text-white border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:underline underline-offset-8 decoration-2 md:p-0 <?php
                                                                                                                                                                                                                                                if ($route == HOME_URL . 'contact') {
                                                                                                                                                                                                                                                    echo "md:underline";
                                                                                                                                                                                                                                                } ?>">Contact</button>
                    </li>
                    <li>
                        <button onclick="redirect('login')" class="text-white border-b border-gray-100 hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-3 md:px-5 <?php if ($route == HOME_URL . 'login') {
                                                                                                                                                                                            echo "md:bg-[#A16C21]";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "bg-[#895B1E]";
                                                                                                                                                                                        } ?>">Connexion</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav> -->

<!-- <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script> -->