<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';



include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Les pensions</h1>
</div>

<div class='divBoarding grid grid-cols-3 grid-rows-1 gap-10 mx-6 my-16 py-4'>
</div>

<div class="modalViewBoarding hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeViewBoardingModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divViewBoarding">

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalEditBoarding hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditBoardingModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditBoarding">

                </div>

            </div>
        </div>
    </div>
</div>

<?php
include 'Includes/footerWebsite.php'
?>

<script>
    getAllBoardingSelect();
</script>