<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/dashboard.php';
?>

<section class="divProfileUser">

</section>

<div class="modalEditProfileUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeEditProfileUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditProfileUser">

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
    getUser('admin');
</script>