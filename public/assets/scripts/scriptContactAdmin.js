function getAllContact() {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/contacts/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayContact(JSON.parse(data));
      }
    });
}

function displayContact(contacts) {
  if (contacts == "") {
    document.querySelector(".tbodyContact").innerHTML = `
    <tr>
        <td colspan="8">Aucune demande de contact trouvée</td>
    </tr>`;
  } else {
    document.querySelector(".tbodyContact").innerHTML = "";

    contacts.forEach((contact) => {
      let dateContact = new Date(contact.date_contact);

      let message = contact.message_contact;

      if (contact.message_contact.length > 50) {
        message = contact.message_contact.slice(0, 50) + "...";
      }

      document.querySelector(".tbodyContact").innerHTML +=
        `
      <tr class="border-b hover:bg-neutral-100">
        <td class="px-6 py-4">` +
        contact.lastname_contact +
        ` ` +
        contact.firstname_contact +
        `
        </td>

        <td class="px-6 py-4 text-wrap"> ` +
        contact.email_contact +
        `
        </td>

        <td class="px-6 py-4 text-wrap">` +
        message +
        `</td>

        <td class="px-6 py-4 text-wrap">` +
        dateContact.toLocaleDateString("fr") +
        `</td>

        <td class="px-6 py-4"> ` +
        statusContact(contact.id_status) +
        `
        </td>

        <td class="px-6 py-4">
          <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="viewContact(` +
        contact.id_contact +
        `)"><i class="fa-solid fa-eye"></i></button>
        </td>
      </tr>
      `;
    });
  }
}

function statusContact(idStatus) {
  if (idStatus == 1) {
    return "<span class='inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-blue-500 bg-blue-100/60'><i class='fa-solid fa-envelope-circle-check mr-1'></i> Non lue</span>";
  } else if (idStatus == 2) {
    return '<span class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-gray-500 bg-gray-100/60"><i class="fa-solid fa-spinner mr-1"></i>En cours</span>';
  } else if (idStatus == 3) {
    return '<span class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60"><i class="fa-regular fa-circle-check mr-1"></i>Traitée</span>';
  }
}

function viewContact(idContact) {
  getContactById(idContact);
}

function getContactById(idContact) {
  let contact = {
    idContact: idContact,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(contact),
  };

  fetch(HOME_URL + "admin/contacts/id", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        openViewContactModal(JSON.parse(data));
      }
    });
}

function openViewContactModal(data) {
  document.querySelector(".modalViewContact").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  if (data.id_status == "1") {
    changeStatus(2, data.id_contact);
  }

  let dateContact = new Date(data.date_contact);

  let hours;
  if (dateContact.getHours() < 10) {
    hours = "0" + dateContact.getHours();
  } else {
    hours = dateContact.getHours();
  }

  let minutes;
  if (dateContact.getMinutes() == 0) {
    minutes = "00";
  } else {
    minutes = dateContact.getMinutes();
  }

  document.querySelector(".divViewContact").innerHTML =
    `
  <div class='flex justify-between items-end'>
    <div>
      <h3 class="text-2xl mb-4">` +
    data.firstname_contact +
    ` ` +
    data.lastname_contact +
    `</h3>
      <a href="mailto:` +
    data.email_contact +
    `" class="underline">` +
    data.email_contact +
    `</a>
    </div>
    <p>
    ` +
    dateContact.toLocaleDateString("fr") +
    ` ` +
    hours +
    `:` +
    minutes +
    ` 
    </p>
  </div>

  <div class='border-y-2 border-slate-200 min-h-32 py-6 my-4 relative'>
    <p class='text-justify mb-7'>
    ` +
    data.message_contact +
    `</p>
    <select name="statusContact" id="statusContact" class="absolute bottom-4 right-0 rounded-md border border-[#e0e0e0] bg-white w-28 py-1 indent-2 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md mr-0">
      <option value='1' class='mb-3 block'><i class='fa-solid fa-envelope-circle-check mr-1'></i> Non lue</option>
      <option value='2' class='mb-3 block'  ` +
    isSelectedStatus12(data.id_status) +
    `><span class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-gray-500 bg-gray-100/60"><i class="fa-solid fa-spinner mr-1"></i>En cours</span></option>
      <option value='3' class='mb-3 block' ` +
    isSelected(data.id_status, 3) +
    `><span class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60"><i class="fa-regular fa-circle-check mr-1"></i>Traitée</span></option>
    </select>
  </div>
  <div class='flex justify-around'>
    <a href="mailto:` +
    data.email_contact +
    `" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="viewContact(` +
    data.id_contact +
    `)">Contacter <i class="fa-solid fa-paper-plane"></i></a>
    
    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openDeleteContactModal(` +
    data.id_contact +
    `)">Supprimer</button>
  </div>
  `;

  const divStatusContact = document.querySelector("#statusContact");

  divStatusContact.addEventListener("change", (event) => {
    changeStatus(event.target.value, data.id_contact);
  });
}

function closeViewContactModal() {
  document.querySelector(".modalViewContact").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function isSelectedStatus12(idStatus) {
  if (idStatus == 1 || idStatus == 2) {
    return "selected";
  } else {
    return "";
  }
}

function changeStatus(idStatus, idContact) {
  let status = {
    idStatus: idStatus,
    idContact: idContact,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(status),
  };

  fetch(HOME_URL + "admin/contacts/status", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        getAllContact();
      }
    });
}

// Delete contact

function openDeleteContactModal(idContact) {
  document.querySelector(".modalDeleteContact").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".deleteContactMessage").innerHTML =
    `<p>Voulez-vous vraiment suppimer ce message ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick=deleteContact(` +
    idContact +
    `) >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDeleteContactModal()>Non</button>
  </div>
  `;
}

function closeDeleteContactModal() {
  document.querySelector(".modalDeleteContact").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function deleteContact(idContact) {
  let contact = {
    idContact: idContact,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(contact),
  };

  fetch(HOME_URL + "admin/contacts/delete", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseDeleteContact(JSON.parse(data));
      }
    });
}

function reponseDeleteContact(data) {
  openSuccessMessage(data.message);
  getAllContact();
  closeViewContactModal();
  closeDeleteContactModal();
}
