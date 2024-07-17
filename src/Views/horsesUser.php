<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarreUser.php';
?>

<h1 class="ml-16 text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'><?php
                                                                                    if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']->getNumberHorse() == 1) {
                                                                                        echo "Mon cheval";
                                                                                    } elseif (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']->getNumberHorse() > 1) {
                                                                                        echo "Mes chevaux";
                                                                                    } ?></h1>

<div class="divUserHorse flex flex-wrap"></div>

<div class="modalEditHorseUser hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditHorseModalUser()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditHorseUser">

                </div>

            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/Includes/footer.php'
?>

<script>
    getUserHorses()
</script>