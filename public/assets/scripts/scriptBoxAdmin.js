function getAllBox(idBoxHorse = 0) {
  fetch(HOME_URL + "admin/box/all")
    .then((res) => res.text())
    .then((data) => {
      displayBox(JSON.parse(data), idBoxHorse);
    });
}

function displayBox(box, idBoxHorse) {
  divBoxUser = document.querySelectorAll(".horseBox");
  divBoxUser.forEach((div) => {
    div.innerHTML = "";
  });

  box.forEach((element) => {
    divBoxUser.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        element.id_box +
        ` class='mb-3 block text-base font-medium text-[#07074D]' 
      ` +
        isSelected(idBoxHorse, element.id_box) +
        ` >` +
        element.name_box +
        `</option>`;
    });
  });
}

getBoxHorse();

function getBoxHorse() {
  fetch(HOME_URL + "admin/box/horse")
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      displayBoxHorse(JSON.parse(data));
    });
}

function displayBoxHorse(data) {
  document.querySelector(".tbodyMeadow").innerHTML = "";
  document.querySelector(".tbodyBox").innerHTML = "";
  data.forEach((element) => {
    if (element.name_box == "Pré") {
      document.querySelector(".tbodyMeadow").innerHTML +=
        `
      <tr class="border-b hover:bg-neutral-100">
          <td class="px-6 py-4">` +
        element.name_box +
        `</td>
           <td class="px-6 py-4">` +
        element.name_horse +
        `</td>
      </tr>
      `;
    } else {
      document.querySelector(".tbodyBox").innerHTML +=
        `
      <tr class="border-b hover:bg-neutral-100">
          <td class="px-6 py-4">` +
        element.name_box +
        `</td>
           <td class="px-6 py-4">` +
        horseName(element.name_horse) +
        `</td>
        <td class="px-6 py-4">
          <button onclick="openEditBoxModal(` +
        element.id_box +
        `, '` +
        element.name_box +
        `', ` +
        element.id_horse +
        `)">
            <i class="fa-solid fa-pen-to-square mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i>
          </button>
          <button onclick="openDeleteBoxModal(` +
        element.id_box +
        `, '` +
        element.name_box +
        `' , ` +
        element.id_horse +
        `)">
            <i class="fa-solid fa-trash mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i> 
          </button>
        </td>
      </tr>
      `;
    }
  });
}

function horseName(nameHorse) {
  if (nameHorse == null) {
    return "";
  } else {
    return nameHorse;
  }
}

//Add box
function openAddBoxModal() {
  document.querySelector(".modalAddBox").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
}

function closeAddBoxModal() {
  document.querySelector(".modalAddBox").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function AddBoxVerification() {
  let boxAdd = document.getElementById("boxAdd").value;
  let errorMessageBox = document.getElementById("errorMessageBox");

  if (boxAdd !== "") {
    if (boxAdd.length <= 50) {
      newbox(boxAdd);
    } else {
      errorMessageBox.innerHTML =
        "Le nom du box ne doit pas faire plus de 50 caractères.";
    }
  } else {
    errorMessageBox.innerHTML = "Merci de remplir tous les champs.";
  }
}

function newbox(nameBox) {
  let newBox = {
    nameBox: nameBox,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newBox),
  };

  fetch(HOME_URL + "admin/box/add", params)
    .then((res) => res.text())
    .then((data) => reponseAddBox(JSON.parse(data)));
}

function reponseAddBox(data) {
  openSuccessMessage(data.message);
  getBoxHorse();
  closeAddBoxModal();
}

// Edit Box
function closeEditBoxModal() {
  document.querySelector(".modalEditBox").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openEditBoxModal(idBox, nameBox, idHorse) {
  // getAllHorses("box", idHorse);

  document.querySelector(".modalEditBox").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".divEditBox").innerHTML =
    `
  <h3 class="text-2xl text-center mb-8">Modifier ` +
    nameBox +
    `</h3>
  <div class="mb-5">
      <label for="birthdateHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Box</label>
      <input type="text" name="boxEdit" id="boxEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    nameBox +
    `' >
  </div>

  <div id="errorMessageBoxEdit"></div>

  <div class="w-fit m-auto mt-8">

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editBoxVerification(` +
    idBox +
    `)">Modifier</button>
  </div>
  `;
}
{
  /* <div class="mb-5">
  <label
    for="horseUser"
    class='mb-3 block text-base font-medium text-[#07074D]"'
  >
    Cheval
  </label>

  <select
    name="horseUser"
    id="boxHorseEdit"
    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"
  ></select>
</div>; */
}

function editBoxVerification(idBox) {
  let boxEdit = document.getElementById("boxEdit").value;
  // let boxHorseEdit = parseInt(document.getElementById("boxHorseEdit").value);
  let errorMessageBoxEdit = document.getElementById("errorMessageBoxEdit");

  if (boxEdit !== "") {
    if (boxEdit.length <= 50) {
      // if (Number(boxHorseEdit) || boxHorseEdit == 0) {
      editBox(idBox, boxEdit);
      // editBox(idBox, boxEdit, boxHorseEdit);

      // } else {
      //   errorMessageBoxEdit.innerHTML = "Merci de selectionner un champ.";
      // }
    } else {
      errorMessageBoxEdit.innerHTML =
        "Le nom du box ne doit pas faire plus de 50 caractères.";
    }
  } else {
    errorMessageBoxEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editBox(idBox, boxEdit, boxHorseEdit) {
  let editBox = {
    idBox: idBox,
    boxEdit: boxEdit,
    boxHorseEdit: boxHorseEdit,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editBox),
  };

  fetch(HOME_URL + "admin/box/edit", params)
    .then((res) => res.text())
    .then((data) => reponseEditBox(JSON.parse(data)));
}

function reponseEditBox(data) {
  openSuccessMessage(data.message);
  getBoxHorse();
  closeEditBoxModal();
}

// Delete Box

function openDeleteBoxModal(idBox, nameBox, idHorse) {
  document.querySelector(".modalDeleteBox").classList.remove("hidden");
  document.querySelector(".deleteBoxMessage").innerHTML =
    `<p>Voulez-vous vraiment suppimer ` +
    nameBox +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#A16C21] text-white border-2 border-[#A16C21] hover:bg-white hover:text-[#A16C21] rounded-xl font-bold" onclick='deleteBox(` +
    idBox +
    `)' >Oui</button>
    <button class="p-2 bg-white text-[#A16C21] border-2 border-[#A16C21] hover:bg-[#A16C21] hover:text-white rounded-xl font-bold" onclick=closeDeleteBoxModal() >Non</button>
  </div>
  `;
}

function closeDeleteBoxModal() {
  document.querySelector(".modalDeleteBox").classList.add("hidden");
}

function deleteBox(idBox) {
  let box = {
    idBox: idBox,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(box),
  };

  fetch(HOME_URL + "admin/box/delete", params)
    .then((res) => res.text())
    .then((data) => {
      reponseDeleteBox(JSON.parse(data));
    });
}

function reponseDeleteBox(data) {
  openSuccessMessage(data.message);
  getBoxHorse();
  closeDeleteBoxModal();
}