<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonNew = new Button('Ajouter', 'openModal()');
$buttonAdd = new Button('Ajouter', 'newHorseVerification()');


?>

<h1>La cavalerie</h1>


<section class="w-1/2 p-8 mx-auto bg-[#C0DF85] rounded-xl relative">
    <button class="absolute right-8 top-4 text-2xl" onclick="closeModal()">
        <i class="fa-regular fa-circle-xmark "></i>
    </button>
    <h3 class="text-2xl text-center mb-8">Ajouter un nouveau cheval</h3>
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="nameHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Nom</label>
                <input type="text" name="nameHorse" id="nameHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseUser" class='mb-3 block text-base font-medium text-[#07074D]"'>Propriétaire</label>

                <select name="horseUser" id="horseUser" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                    <option value="1" class='mb-3 block text-base font-medium text-[#07074D]"'>Manu</option>
                    <option value="2" class='mb-3 block text-base font-medium text-[#07074D]"'>Marie</option>
                </select>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <label for="imageHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Image</label>
        <input type="text" name="imageHorse" id="imageHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="breedHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Race</label>
                <input type="text" name="breedHorse" id="breedHorse" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseBox" class='mb-3 block text-base font-medium text-[#07074D]"'>Box</label>

                <select name="horseBox" id="horseBox" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                    <option value="1" class='mb-3 block text-base font-medium text-[#07074D]"'>Box 1</option>
                    <option value="2" class='mb-3 block text-base font-medium text-[#07074D]"'>Box 2</option>
                    <option value="3" class='mb-3 block text-base font-medium text-[#07074D]"'>Au pré</option>

                </select>
            </div>
        </div>
    </div>

    <div id="errorMessageHorses"></div>

    <div class="w-fit m-auto mt-8">

        <?= $buttonAdd->create_btn() ?>
    </div>

</section>


<?php
include 'Includes/footer.php'
?>