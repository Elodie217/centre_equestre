<?php

include __DIR__ . '/Includes/headerWebsite.php';
include __DIR__ . '/Includes/navBarreUser.php';


?>


<div id='calendarUser' class="mt-10 mb-40 sm:my-10 mx-auto w-10/12"></div>

<div class="modalChangeCalendarLessonUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto w-11/12 md:w-9/12 mx-auto my-8">
        <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl p-6 ">
            <button class=" absolute right-8 top-4 text-2xl" onclick="closeChangeCalendarLessonUserModal()">
                <i class="fa-regular fa-circle-xmark "></i>

            </button>
            <h3>Cliquez sur un nouveau cours :</h3>
            <div id='calendarUserChangeLesson'></div>

        </div>
    </div>
</div>

<div class="modalChangeLessonUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeChangeLessonUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divChangeLessonUser">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modalDeleteLessonUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 max-[400px]:right-4 max-[400px]:top-2 text-2xl" onclick="closeDeleteLessonUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divDeleteLessonUser">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="eventPopup" class="popup hidden fixed z-20 bg-white border-2 p-4 rounded left-1/2 transform -translate-x-1/2 top-1/2 transform -translate-y-1/2 "></div>


<?php
include __DIR__ . '/Includes/footer.php'
?>