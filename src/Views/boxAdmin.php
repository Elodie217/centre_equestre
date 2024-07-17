<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonNew = new Button('Ajouter un box', 'openAddBoxModal()');
$buttonAdd = new Button('Ajouter', 'AddBoxVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Les box</h1>

    <div class="mr-10">

        <?= $buttonNew->create_btn() ?>
    </div>
</div>

<section class="flex flex-wrap justify-around"><!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white my-6 mx-2">

        <!-- Table -->
        <table class="w-fit text-left text-md whitespace-nowrap">

            <!-- Table head -->
            <thead class="uppercase tracking-wider border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        Box
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Cheval
                    </th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="tbodyBox">

            </tbody>

        </table>

    </div>
    <div class="overflow-x-auto bg-white my-6 mx-2">

        <!-- Table -->
        <table class="w-fit text-left text-md whitespace-nowrap mr-20">

            <!-- Table head -->
            <thead class="uppercase tracking-wider border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        Pré
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Cheval
                    </th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="tbodyMeadow">

            </tbody>

        </table>

    </div>
</section>

<div class="modalAddBox hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeAddBoxModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <h3 class="text-2xl text-center mb-8">Ajouter un nouveau Box</h3>
                <div class="mb-5">
                    <label for="boxAdd" class='mb-3 block text-base font-medium text-[#07074D]"'>Box</label>
                    <input type="text" name="boxAdd" id="boxAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>

                <!--   <div class="mb-5">
                    <label for="horseUser" class='mb-3 block text-base font-medium text-[#07074D]"'>Cheval</label>

                    <select name="horseUser" id="boxHorseAdd" class="horseUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>-->

                <div id="errorMessageBox"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonAdd->create_btn() ?>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modalEditBox hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditBoxModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditBox">

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modalDeleteBox hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeDeleteBoxModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteBoxMessage"></div>

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
    getBoxHorse();
</script>