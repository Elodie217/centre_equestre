<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonNew = new Button('Ajouter', 'openAddHorseModal()');
$buttonAdd = new Button('Ajouter', 'newHorseVerification()');

include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>La cavalerie</h1>

    <div class="mr-10">

        <?= $buttonNew->create_btn() ?>
    </div>
</div>

<div class="bg-cover w-full flex justify-center items-center">
    <div class="w-full backdrop-filter backdrop-blur-lg">
        <div class="w-full mx-auto rounded-2xl backdrop-filter px-2 backdrop-blur-lg">

            <div class="divCards grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mx-auto">

            </div>
        </div>
    </div>
</div>


<div class="modalAddHorse hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 font-medium">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeAddHorseModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <h3 class="text-2xl text-center mb-8 mx-10">Ajouter un nouveau cheval</h3>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="nameHorse" class='mb-3 block text-base'>Nom*</label>
                            <input type="text" name="nameHorse" id="nameHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=''>
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="horseUser" class='mb-3 block text-base'>Propriétaire*</label>

                            <select name="horseUser" id="horseUserAdd" class="horseUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                            </select>
                        </div>
                    </div>
                </div>


                <div class="mb-5">
                    <label for="imageHorse" class='mb-3 block text-base'>Image*</label>
                    <input type="text" name="imageHorse" id="imageHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=''>
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="birthdateHorse" class='mb-3 block text-base"'>Date de naissance*</label>
                            <input type="date" name="birthdateHorse" id="birthdateHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" max="<?= date("m-d-y") ?>">
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="heightHorse" class='mb-3 block text-base'>Taille (en cm)</label>
                            <input type="number" min=0 max=200 placeholder="120" name="heightHorse" id="heightHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=''>
                        </div>
                    </div>
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="coatHorse" class='mb-3 block text-base'>Robe</label>
                            <input type="text" name="coatHorse" placeholder="Alezan" id="coatHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=''>
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="horseBox" class='mb-3 block text-base"'>Box*</label>

                            <select name="horseBox" id="horseBoxAdd" class="horseBox w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="boardingHorse" class='mb-3 block text-base'>Pension*</label>
                    <select name="boardingHorse" id="boardingHorse" class="boardingHorse w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                    </select>
                </div>

                <div id="errorMessageHorses" class="text-[#ff2727]"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonAdd->create_btn() ?>
                </div>


            </div>
        </div>
    </div>
</div>


<div class="modalEditHorse hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeEditHorseModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditHorse">

                </div>

            </div>
        </div>
    </div>
</div>



<div class="modalDeleteHorse hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeDeleteHorseModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteHorseMessage"></div>

            </div>
        </div>
    </div>
</div>


</div>
</div>
</div>
<?php
include 'Includes/footerWebsite.php'
?>
<script>
    getAllHorses();
</script>