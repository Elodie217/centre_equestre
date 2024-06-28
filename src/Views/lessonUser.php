<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarreUser.php';
?>

<div id='calendarUser' class="m-10"></div>

<div class="modalChangeCalendarLessonUser hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto w-11/12 md:w-10/12 mx-auto my-8">
        <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl p-6 ">
            <button class="absolute right-8 top-4 text-2xl" onclick="closeChangeCalendarLessonUserModal()">
                <i class="fa-regular fa-circle-xmark "></i>

            </button>
            <h3>Cliquez sur un nouveau cours :</h3>
            <div id='calendarUserChangeLesson'></div>

        </div>
    </div>
</div>

<div class="modalChangeLessonUser hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeChangeLessonUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divChangeLessonUser">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modalDeleteLessonUser hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeDeleteLessonUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divDeleteLessonUser">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="eventPopup" class="popup hidden absolute z-10 bg-white border-2 p-4 rounded"></div>


<?php
include __DIR__ . '/Includes/footer.php'
?>