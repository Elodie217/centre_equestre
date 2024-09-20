<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonAdd = new Button('Ajouter', 'newLessonVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>


<div id='calendar'></div>



<div class="modalAddLesson hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeAddLessonModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="divAddLesson">
                    <h3 class="text-2xl text-center mb-8">Ajouter un nouveau cours</h3>
                    <div class="-mx-3 flex flex-wrap font-medium text-base">

                        <div class="w-full px-3 mb-5">
                            <label for="titleLessonAdd" class='mb-3 block'>Titre</label>
                            <input type="text" name="titleLessonAdd" id="titleLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black outline-none focus:border-[#C0DF85] focus:shadow-md">
                        </div>

                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="dateLessonAdd" class='mb-3 block'>Date</label>
                                <input type="date" name="dateLessonAdd" id="dateLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black outline-none focus:border-[#C0DF85] focus:shadow-md">
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="hourLessonAdd" class='mb-3 block'>Heure</label>

                                <input type="time" name="hourLessonAdd" id="hourLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5 relative">
                                <div class='mb-3 block'>Niveaux
                                    <button onclick="openAddLevel()"><i class="ml-1 fa-solid fa-circle-plus"></i></button>
                                </div>
                                <div class="absolute divAddLevel hidden top-8 w-52 p-2 bg-white rounded-xl bg-white border-[#C0DF85] border-2">
                                    <div class="divAddLevelDisplay overflow-y-auto max-h-32">
                                    </div>

                                    <div class="flex justify-between my-2">
                                        <input type="text" id="inputNewLevel" placeholder="Galop 1" class="w-36 rounded-md border border-[#e0e0e0] bg-white py-1 px-2 text-black outline-none focus:border-[#C0DF85] focus:shadow-md">
                                        <button onclick="addLevel()" class="text-3xl mr-1 text-[#895B1E] hover:text-[#A16C21]"><i class="ml-1 fa-solid fa-circle-plus"></i></i></button>
                                    </div>
                                    <p class="text-[#ff2727] text-sm errorMessageLevelAdd"></p>
                                </div>

                                <div class="divLessonLevel flex flex-wrap">

                                </div>

                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="placeLessonAdd" class='mb-3 block '>Places</label>
                                <input type="number" min=1 name="placeLessonAdd" id="placeLessonAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black outline-none focus:border-[#C0DF85] focus:shadow-md">
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <p class='mb-3 block'>Participants</p>
                        <div class="lessonUser grid grid-cols-1 sm:grid-cols-2 h-24 overflow-auto"></div>
                    </div>

                </div>
                <div id="errorMessageLessonAdd" class="text-[#ff2727]"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonAdd->create_btn() ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalViewLesson hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
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
    <div class="fixed inset-0 z-20 overflow-y-auto">
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
    <div class="fixed inset-0 z-20 overflow-y-auto">
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