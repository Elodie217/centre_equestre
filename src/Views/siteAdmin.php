<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonEdit = new Button('Modifier', 'editSoonVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Le site</h1>
</div>

<section class="m-10">
    <div class="flex">
        <h2 class="text-3xl">Prochainement</h2>
        <button onclick="openEditSoonModal()"><i class="fa-solid fa-pen-to-square mx-2 p-1 transition-all duration-200 transform hover:scale-125"></i></button>
    </div>
    <div class="md:flex justify-around items-center">
        <div class="md:w-1/2 p-4 pl-0">
            <div class=" flex justify-between">
                <h3 id="AdminSoonSiteTitle" class="text-xl font-semibold mr-2"></h3>
                <p id="AdminSoonSiteDate" class="text-xl font-semibold ml-2"></p>
            </div>
            <div id="AdminSoonSiteDescription" class="text-justify mt-5"></div>
        </div>
        <img id="AdminSoonSiteImg" src="" alt="Photo de l'événenement à venir" class="md:w-1/2 p-4">
    </div>
</section>


<div class="modalEditSoon hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditSoonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <h3 class="text-2xl text-center mb-8">Modifier</h3>

                <div class="mb-5">
                    <label for="titleEditSoon" class='mb-3 block text-base font-medium text-[#07074D]"'>Titre*</label>
                    <input type="text" name="titleEditSoon" id="titleEditSoon" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>
                <div class="mb-5">
                    <label for="dateEditSoon" class='mb-3 block text-base font-medium text-[#07074D]"'>Date/Période*</label>
                    <input type="text" name="dateEditSoon" id="dateEditSoon" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>
                <div class="mb-5">
                    <label for="descriptionEditSoon" class='mb-3 block text-base font-medium text-[#07074D]"'>Description*</label>
                    <textarea name="descriptionEditSoon" id="descriptionEditSoon" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md h-40"></textarea>
                </div>
                <div class="mb-5">
                    <label for="imageEditSoon" class='mb-3 block text-base font-medium text-[#07074D]"'>Image*</label>
                    <input type="text" name="imageEditSoon" id="imageEditSoon" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>

                <div id="errorMessageEditSoon" class="mt-6 mx-4 text-[#ff2727]"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonEdit->create_btn()
                    ?>
                </div>
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
    getSite()
</script>