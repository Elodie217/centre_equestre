<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonAdd = new Button('Ajouter', 'newLessonVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>


<div id='calendar'></div>



<div class="modalAddLesson hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeAddLessonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="divAddLesson">
                    <h3 class="text-2xl text-center mb-8">Ajouter un nouveau cours</h3>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="dateLessonAdd" class='mb-3 block text-base font-medium text-[#07074D]"'>Date</label>
                                <input type="date" name="dateLessonAdd" id="dateLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="hourLessonAdd" class='mb-3 block text-base font-medium text-[#07074D]"'>Heure</label>

                                <input type="time" name="hourLessonAdd" id="hourLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <div class='mb-3 block text-base font-medium text-[#07074D]"'>Niveau(x)</div>

                                <div class="divLessonLevel flex flex-wrap">

                                </div>

                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="placeLessonAdd" class='mb-3 block text-base font-medium '>Places</label>
                                <input type="number" min=1 name="placeLessonAdd" id="placeLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <p class='mb-3 block text-base font-medium '> Participants</p>
                        <div class="lessonUser flex flex-col h-24 overflow-auto"></div>
                    </div>

                </div>
                <div id="errorMessageLessonAdd"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonAdd->create_btn() ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalViewLesson hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeViewLessonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divViewLesson">

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalEditLesson hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditLessonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="divEditLesson">

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalDeleteLesson hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeDeleteLessonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteLessonMessage"></div>

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