<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

$buttonNew = new Button('Ajouter un cavalier', 'openAddUserModal()');
$buttonAdd = new Button('Ajouter', 'AddUserVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Les utilisateurs</h1>

    <div class="mr-10">

        <?= $buttonNew->create_btn() ?>
    </div>
</div>

<section class="flex flex-wrap justify-around">
    <div class="overflow-x-auto bg-white my-6 mx-2">

        <!-- Table -->
        <table class="w-fit text-left text-md whitespace-nowrap">

            <!-- Table head -->
            <thead class="uppercase tracking-wider border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        Nom
                        <button onclick="chooseOrder('lastname_user')">
                            <i class="ml-2 fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Prénom
                        <button onclick="chooseOrder('firstname_user')">
                            <i class="ml-2 fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-4">
                        email
                    </th>
                    <th scope="col" class="px-6 py-4">
                        téléphone
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Niveau
                    </th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="tbodyUser">

            </tbody>
        </table>
    </div>
</section>

<div class="modalViewUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeViewUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divViewUser">

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modalAddUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeAddUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <h3 class="text-2xl text-center mb-8">Ajouter un nouveau cavalier</h3>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="lastnameUserAdd" class='mb-3 block text-base font-medium  "'>Nom*</label>
                            <input type="text" name="lastnameUserAdd" id="lastnameUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                            </select>
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="firstnameUserAdd" class='mb-3 block text-base font-medium  "'>Prénom*</label>
                            <input type="text" name="firstnameUserAdd" id="firstnameUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="emailUserAdd" class='mb-3 block text-base font-medium  "'>Email*</label>
                    <input type="text" name="emailUserAdd" id="emailUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="phoneUserAdd" class='mb-3 block text-base font-medium  "'>Téléphone</label>
                            <input type="tel" name="phoneUserAdd" id="phoneUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="birthdateUserAdd" class='mb-3 block text-base font-medium  "'>Date de naissance</label>
                            <input type="date" name="birthdateUserAdd" id="birthdateUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="addressUserAdd" class='mb-3 block text-base font-medium  "'>Adresse</label>
                    <input type="text" name="addressUserAdd" id="addressUserAdd" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="roleUserAdd" class='mb-3 block text-base font-medium  "'>Role*</label>
                            <select name="roleUserAdd" id="roleUserAdd" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>

                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="levelUserAdd" class='mb-3 block text-base font-medium  "'>Niveau</label>

                            <select name="levelUserAdd" id="levelUserAdd" class="levelUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                            </select>
                        </div>
                    </div>
                </div>

                <div id="errorMessageUserAdd"></div>

                <div class="w-fit m-auto mt-8">

                    <?= $buttonAdd->create_btn()
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalEditUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeEditUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>
                <div class="divEditUser">

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modalDeleteDisableUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeDeleteDisableUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteDisableUserMessage"></div>

            </div>
        </div>
    </div>
</div>

<div class="modalDeleteUser hidden">
    <div class="fixed inset-0 z-20 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class=" relative overflow-hidden rounded-xl bg-white border-[#C0DF85] border-4 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-6 ">
                <button class="absolute right-8 top-4 text-2xl" onclick="closeDeleteUserModal()">
                    <i class="fa-regular fa-circle-xmark "></i>
                </button>

                <div class="deleteUserMessage"></div>

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
    chooseOrder('lastname_user')
</script>