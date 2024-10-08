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
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeEditHorseModalUser()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditHorseUser">
                    <h3 class="text-2xl text-center mb-8 mx-10" id="h3EditHorseUser"></h3>
                    <div class="-mx-3 flex flex-wrap font-medium">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="nameHorse" class='mb-3 block text-base'>Nom*</label>
                                <input type="text" name="nameHorse" id="nameHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=''>
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="birthdateHorse" class='mb-3 block text-base'>Date de naissance*</label>
                                <input type="date" name="birthdateHorse" id="birthdateHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="imageHorseEditUser" class='mb-3 block text-base'>Image*</label>

                        <div class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md flex flex-col items-center">

                            <input id="imageHorseEditUser" type="file" name="imageHorseEditUser" class="w-full appearance-none">
                            <img src="" alt="Aperçu" id="previewimageHorseEditUser" class="mt-4 max-h-80">
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">

                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="heightHorse" class='mb-3 block text-base'>Taille (en cm)</label>
                                <input type="number" min=0 max=200 placeholder="120" name="heightHorse" id="heightHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="">
                            </div>
                        </div>

                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="coatHorse" class='mb-3 block text-base'>Robe</label>
                                <input type="text" name="coatHorse" placeholder="Alezan" id="coatHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="">
                            </div>
                        </div>

                    </div>


                    <div id="errorMessageHorsesEditUser" class="text-[#ff2727]"></div>

                    <div class="w-fit m-auto mt-8" id="btnEditHorseVerificationUser">

                    </div>

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