<div class="flex flex-col h-screen">

    <!-- Barre de navigation en haut -->
    <div class="bg-[#64832F] shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center">

            <a href="#" class="flex items-center">
                <img src="/public/assets/images/logo.png" alt="Logo des cavaliers des vallées" class='max-w-24 ml-4 mr-6'>
                <h2 class="font-bold text-4xl text-white" style='font-family: "Amatic SC", sans-serif;'>Les cavaliers des vallées</h2>
            </a>

        </div>

        <div class="space-x-6 mr-4 flex">
            <button class="space-x-6 mr-4 flex items-center" onClick="redirect('admin/profile')">
                <p class='text-white text-xl'>

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
        <div class="md:hidden absolute flex items-center">
            <button id="menuBtn" onClick='menu()'>
                <i class="fas fa-bars bg-[#64832F] text-white p-2 rounded-full text-xl m-2"></i>
            </button>
        </div>
        <div class="p-2 pt-0 bg-[#64832F] w-full md:w-56 lg:w-60 flex flex-col md:flex hidden" id="sideNav">
            <nav>
                <button onCLick='fermerMenu()' class='md:hidden'>
                    <i class="fa-solid fa-xmark text-xl text-white"></i>
                </button>
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

        <div class="flex-1 p-4 w-full md:w-1/2">



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
                function afficherUser() {
                    document.querySelector(".divUser").classList.remove('hidden')
                    document.querySelector(".flou").classList.remove('hidden')
                }

                function fermerUser() {
                    document.querySelector(".divUser").classList.add('hidden')
                    document.querySelector(".flou").classList.add('hidden')
                }
            </script>

            <script>
                // let usersChart = new Chart(document.getElementById('usersChart'), {
                //     type: 'doughnut',
                //     data: {
                //         labels: ['Nuevos', 'Registrados'],
                //         datasets: [{
                //             data: [30, 65],
                //             backgroundColor: ['#00F0FF', '#8B8B8D'],
                //         }]
                //     },
                //     options: {
                //         responsive: true,
                //         maintainAspectRatio: false,
                //         legend: {
                //             position: 'bottom'
                //         }
                //     }
                // });

                // let commercesChart = new Chart(document.getElementById('commercesChart'), {
                //     type: 'doughnut',
                //     data: {
                //         labels: ['Nuevos', 'Registrados'],
                //         datasets: [{
                //             data: [60, 40],
                //             backgroundColor: ['#FEC500', '#8B8B8D'],
                //         }]
                //     },
                //     options: {
                //         responsive: true,
                //         maintainAspectRatio: false,
                //         legend: {
                //             position: 'bottom'
                //         }
                //     }
                // });


                function menu() {
                    const sideNav = document.getElementById('sideNav');

                    sideNav.classList.remove('hidden');
                    document.getElementById('menuBtn').classList.add('hidden')

                }

                function fermerMenu() {
                    const sideNav = document.getElementById('sideNav');

                    sideNav.classList.add('hidden');

                    document.getElementById('menuBtn').classList.remove('hidden')

                }
            </script>