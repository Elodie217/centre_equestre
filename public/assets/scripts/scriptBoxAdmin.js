function getAllBox(idBoxHorse = 0) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/box/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayBox(JSON.parse(data), idBoxHorse);
      }
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
        ` class='mb-3 block text-base font-medium  ' 
      ` +
        isSelected(idBoxHorse, element.id_box) +
        ` >` +
        element.name_box +
        `</option>`;
    });
  });
}

function getBoxHorse() {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/box/horse", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayBoxHorse(JSON.parse(data));
      }
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newBox),
  };

  fetch(HOME_URL + "admin/box/add", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseAddBox(JSON.parse(data));
      }
    });
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
  document.querySelector(".modalEditBox").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".divEditBox").innerHTML =
    `
  <h3 class="text-2xl text-center mb-8 mx-10">Modifier ` +
    nameBox +
    `</h3>
  <div class="mb-5">
      <label for="birthdateHorse" class='mb-3 block text-base font-medium '>Box</label>
      <input type="text" name="boxEdit" id="boxEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    nameBox +
    `' >
  </div>

  <div id="errorMessageBoxEdit" class="text-[#ff2727]"></div>

  <div class="w-fit m-auto mt-8">

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editBoxVerification(` +
    idBox +
    `)">Modifier</button>
  </div>
  `;
}

function editBoxVerification(idBox) {
  let boxEdit = document.getElementById("boxEdit").value;
  let errorMessageBoxEdit = document.getElementById("errorMessageBoxEdit");

  if (boxEdit !== "") {
    if (boxEdit.length <= 50) {
      editBox(idBox, boxEdit);
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editBox),
  };

  fetch(HOME_URL + "admin/box/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditBox(JSON.parse(data));
      }
    });
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
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick='deleteBox(` +
    idBox +
    `)' >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDeleteBoxModal() >Non</button>
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(box),
  };

  fetch(HOME_URL + "admin/box/delete", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseDeleteBox(JSON.parse(data));
      }
    });
}

function reponseDeleteBox(data) {
  openSuccessMessage(data.message);
  getBoxHorse();
  closeDeleteBoxModal();
}
