<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';


include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Contacts</h1>


</div>

<div class="overflow-x-auto my-6 mx-2">
    <table class="w-fit text-left text-base whitespace-nowrap">

        <thead class="uppercase tracking-wider border-b-2">
            <tr>
                <th scope="col" class="px-6 py-4">
                    Nom Prénom
                </th>
                <th scope="col" class="px-6 py-4">
                    Email
                </th>
                <th scope="col" class="px-6 py-4">
                    Message
                </th>
                <th scope="col" class="px-6 py-4">
                    Date
                </th>
                <th scope="col" class="px-6 py-4">
                    Statut
                </th>
                <th scope="col" class="px-6 py-4">
                </th>
            </tr>
        </thead>


        <tbody class="tbodyContact">

        </tbody>

    </table>
</div>

<div class="modalViewContact hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeViewContactModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divViewContact">

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modalDeleteContact hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeDeleteContactModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteContactMessage"></div>

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
    getAllContact();
</script>