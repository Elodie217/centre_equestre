<div class="flex flex-col h-screen">

    <!-- Barre de navigation en haut -->
    <div class="bg-[#64832F] shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center">
            <a href="#" class="flex items-center mx-2 px-6">
                <img src="/public/assets/images/logo.png" alt="Logo des cavaliers des vallées" class='max-w-24 ml-4 sm:mr-6'>
                <h2 class="text-4xl hidden sm:block" style='font-family: "Amatic SC", sans-serif;'>Les cavaliers des vallées</h2>
            </a>

        </div>

        <div class="space-x-6 mr-4 flex">
            <button class="space-x-6 mr-4 flex items-center" onClick="redirect('admin/profile')">
                <p class='max-[350px]:hidden text-white text-xl'>

                    <?php
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        echo $_SESSION['user']->getFirstnameUser() . ' ';
                    }
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        echo $_SESSION['user']->getLastnameUser();
                    } ?>

                </p>
                <i class="fas fa-user text-white text-xl"></i>
            </button>
        </div>
    </div>


    <!-- Barre de navigation à gauche -->
    <div class="flex-1 relative flex flex-wrap">
        <div class="md:hidden z-[15] absolute flex items-center">
            <button id="dashboardBtn" onClick='openDashboard()'>
                <i class="fas fa-bars bg-[#64832F] text-white p-2 rounded-full text-xl m-2"></i>
            </button>
            <button onCLick='closeDashboard()' id='btnCloseDashboard' class='hidden'>
                <i class="fa-solid fa-xmark bg-[#64832F] text-white p-2 rounded-full text-xl m-2"></i>
            </button>
        </div>

        <div class="absolute z-10 md:z-0 md:static px-10 md:p-2 pt-10 md:pt-0 bg-[#64832F] w-full md:w-56 lg:w-60 flex flex-col md:flex hidden" id="sideNav">
            <nav>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/lessons')">
                    <i class="fa-solid fa-calendar-week mr-2"></i>Cours
                </button>

                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/horses')">
                    <i class="fa-solid fa-horse mr-2"></i>Chevaux
                </button>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/box')">
                    <i class="fa-solid fa-warehouse mr-2"></i>Box
                </button>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/boarding')">
                    <i class="fa-solid fa-handshake-simple mr-2"></i>Pension
                </button>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/contacts')">
                    <i class="fa-solid fa-comments mr-2"></i>Prise de contact
                </button>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/users')">
                    <i class="fas fa-users mr-2"></i>Utilisateurs
                </button>
                <button class="block text-white py-2.5 px-4 my-2.5 rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white w-full text-left" onclick="redirect('admin/site')">
                    <i class="fa-solid fa-file-pen mr-2"></i>Site
                </button>
            </nav>

            <div class='md:fixed md:top-[85%] md:w-52 lg:w-56 '>
                <!-- Déconnexion -->
                <button onclick="logout()" class="block w-full text-white py-2.5 px-4 my-2.5 text-left rounded transition duration-200 hover:bg-gradient-to-r from-[#895B1E] to-[#A16C21] hover:text-white mt-auto" href="">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </button>

                <div class="bg-[#C0DF85] h-px"></div>

                <p class="mb-1 px-5 py-3 text-left text-xs text-[#C0DF85]">Copyright CE@2024</p>
            </div>

        </div>

        <div class="flex-1 p-2 sm:p-4 w-full mt-8 md:mt-0 md:w-1/2">



            <!-- <div class='divUser hidden fixed bg-white z-10 top-[25%] md:left-[40%] sm:left-[30%] left-[20%] py-8 px-12 text-lg rounded-xl shadow-2xl'>
                <div class='relative flex my-2.5 mb-6 text-2xl items-center'>
                    <i class="fas fa-user text-2xl mr-4"></i>
                    <p class='font-bold'>{{user.prenomUtilisateur}} {{user.nomUtilisateur}}</p>
                </div>
                <button onClick=fermerUser() class=' text-2xl absolute top-[10px] right-[15px]'>
                    <i class="fa-regular fa-circle-xmark"></i>
                </button>
                <p class='my-2.5'><span class='font-bold'>Email :</span> {{user.email}}</p>
                <p class='my-2.5'><span class='font-bold'>Téléphone :</span> {{user.telephoneUtilisateur}}</p>
                <p class='my-2.5'><span class='font-bold'>Rôles :</span> {% for role in user.roles %}
                    {{role}}
                    {% endfor %}
                </p>

                <a href="{{ path('app_user_edit', {'id': user.id}) }}" class='block text-white py-1.5 px-4 mr-2 h-fit w-fit rounded transition duration-200 bg-[#895B1E] hover:bg-[#FF7B00] text-lg my-2.5'>Modifier mon profil</a>

            </div>-->

            <script>
                // function afficherUser() {
                //     document.querySelector(".divUser").classList.remove('hidden')
                //     document.querySelector(".flou").classList.remove('hidden')
                // }

                // function fermerUser() {
                //     document.querySelector(".divUser").classList.add('hidden')
                //     document.querySelector(".flou").classList.add('hidden')
                // }
            </script>

            <script>
                // function menu() {
                //     const sideNav = document.getElementById('sideNav');

                //     sideNav.classList.remove('hidden');
                //     document.getElementById('menuBtn').classList.add('hidden')

                // }

                // function fermerMenu() {
                //     const sideNav = document.getElementById('sideNav');

                //     sideNav.classList.add('hidden');

                //     document.getElementById('menuBtn').classList.remove('hidden')

                // }
            </script>