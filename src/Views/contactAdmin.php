<?php
include __DIR__ . '/Includes/headerWebsite.php';
require_once __DIR__ . '/Includes/Button.php';

// $buttonAdd = new Button('Ajouter', 'AddBoxVerification()');


include __DIR__ . '/Includes/dashboard.php';
?>

<div class="flex justify-between items-center my-6 mx-6">
    <h1 class="text-4xl ">Contacts</h1>


</div>

<table class="min-w-full max-w-5xl text-left text-base whitespace-nowrap">

    <thead class="uppercase tracking-wider border-b-2">
        <tr>
            <th scope="col" class="px-6 py-4">
                Id
            </th>
            <th scope="col" class="px-6 py-4">
                Nom, Prénom
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

    <!-- Table body -->
    <tbody>

        {% for adv_reservation in adv_reservations %}
        <tr class="border-b hover:bg-neutral-100">
            <td class="px-6 py-4">{{ adv_reservation.id }}</td>
            <td class="px-6 py-4">
                {% if adv_reservation.user %}
                {{ adv_reservation.user.nomUtilisateur }} {{ adv_reservation.user.prenomUtilisateur }}
                {% endif %}
            </td>

            <td class="px-6 py-4 text-wrap">
                {% if adv_reservation.advVoyage %}
                {{ adv_reservation.advVoyage.destinationVoyage }}

            </td>
            {% endif %}

            <td class="px-6 py-4 text-wrap">{{ adv_reservation.messageReservation }}</td>
            <td class="px-6 py-4">
                {% if adv_reservation.statut %}

                {% if adv_reservation.statut.id == 1 %}
                <span class='inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-blue-500 bg-blue-100/60'><i class="fa-solid fa-envelope-circle-check mr-1"></i> {{ adv_reservation.statut.statut }}</span>
                {% elseif  adv_reservation.statut.id == 2 %}
                <span class='inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-gray-500 bg-gray-100/60'><i class="fa-solid fa-spinner mr-1"></i> {{ adv_reservation.statut.statut }}</span>
                {% elseif  adv_reservation.statut.id == 3 %}
                <span class='inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60'><i class="fa-solid fa-circle-xmark mr-1"></i> {{ adv_reservation.statut.statut }}</span>
                {% elseif  adv_reservation.statut.id == 4 %}
                <span class='inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60'><i class="fa-regular fa-circle-check mr-1"></i> {{ adv_reservation.statut.statut }}</span>
                {% endif %}


                {% endif %}
            </td>
            <td class="px-6 py-4 flex ">
                <button onClick=popUp() class='text-[#FF9029] mr-4 transition duration-200 hover:text-[#FF7B00]'>Modifier</button>
                {{ include('adv_reservation/_delete_form.html.twig') }}
            </td>
        </tr>

        {% endfor %}
        {% else %}
        <tr>
            <td colspan="8">Aucune réservation trouvée</td>
        </tr>
    </tbody>

</table>



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