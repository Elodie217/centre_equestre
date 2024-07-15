// getAllHorses();
function getAllHorses(divDisplay = "horse", idHorse = 0) {
  fetch(HOME_URL + "admin/horses/all")
    .then((res) => res.text())
    .then((data) => {
      if (divDisplay == "horse") {
        displayHorses(JSON.parse(data));
      } else if (divDisplay == "box") {
        displayBoxHorses(JSON.parse(data), idHorse);
      }
    });
}

function displayBoxHorses(horses, idHorse) {
  divBoxHorse = document.querySelector("#boxHorseEdit");
  divBoxHorse.innerHTML +=
    `
      <option value=0 class='mb-3 block text-base font-medium text-[#07074D]' 
      ` +
    isSelected(idHorse, 0) +
    ` ></option>`;
  horses.forEach((element) => {
    divBoxHorse.innerHTML +=
      `
      <option value=` +
      element.id_horse +
      ` class='mb-3 block text-base font-medium text-[#07074D]' 
      ` +
      isSelected(idHorse, element.id_horse) +
      ` >` +
      element.name_horse +
      `</option>`;
  });
}

function displayHorses(Horses) {
  document.querySelector(".divCards").innerHTML = "";
  Horses.forEach((horse) => {
    const birthdateHorse = new Date(horse.birthdate_horse);

    document.querySelector(".divCards").innerHTML +=
      `
  <article class="bg-white h-fit  p-8 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl border relative">
    
    <div class="relative mb-4 rounded-2xl">
        <img class=" rounded-2xl min-h-44 max-h-72 mx-auto object-cover transition-transform duration-300 transform group-hover:scale-105" src="` +
      horse.image_horse +
      `" alt="Photo de ` +
      horse.name_horse +
      `">

    </div>
    <div class="flex w-full pb-4 mb-auto">
        <p class=" font-bold text-xl duration-200 ">` +
      horse.name_horse +
      `</p>
        
        </div>
        
        <p class='mb-2 text-base'>Propiétaire : ` +
      horse.firstname_user +
      ` ` +
      horse.lastname_user +
      `</p>

      <p class='mb-2 text-base'>Date de naissance : ` +
      birthdateHorse.toLocaleDateString("fr") +
      `</p>

      <p class='mb-2 text-base'>Taille (en cm) : ` +
      isNull(horse.height_horse) +
      `</p>

      <p class='mb-3 text-base'>Robe : ` +
      isNull(horse.coat_horse) +
      `</p>

      <p class='mb-2 text-base italic'>` +
      isNull(horse.name_boarding) +
      `</p>

      <p class='mb-4 text-base text-right font-bold '>` +
      horse.name_box +
      `</p>

      <div class='flex absolute text-xl bottom-4 right-4'>
        <button onclick="getHorseById(` +
      horse.id_horse +
      `)"><i class="fa-solid fa-pen-to-square mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i> </button>
        <button onclick="openDeleteHorseModal(` +
      horse.id_horse +
      `, '` +
      horse.name_horse +
      `')"><i class="fa-solid fa-trash mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i> </button>
      </div> 
    </article>
        
       `;
  });
}

// Add Horse
function openAddHorseModal() {
  document.querySelector(".modalAddHorse").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
  getAllBox();
  getAllUserSelect();
  getAllBoardingSelect("horse");
}

function closeAddHorseModal() {
  document.querySelector(".modalAddHorse").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function newHorseVerification() {
  let nameHorse = document.getElementById("nameHorse").value;
  let imageHorse = document.getElementById("imageHorse").value;
  let birthdateHorse = document.getElementById("birthdateHorse").value;
  let horseUser = parseInt(document.getElementById("horseUserAdd").value);
  let heightHorse = document.getElementById("heightHorse").value;
  let coatHorse = document.getElementById("coatHorse").value;
  let horseBox = parseInt(document.getElementById("horseBoxAdd").value);
  let boardingHorse = parseInt(document.getElementById("boardingHorse").value);
  let errorMessageHorses = document.getElementById("errorMessageHorses");
  errorMessageHorses.innerHTML = "";

  if (
    nameHorse !== "" &&
    imageHorse !== "" &&
    birthdateHorse !== "" &&
    horseUser !== "" &&
    horseBox !== "" &&
    boardingHorse !== ""
  ) {
    if (nameHorse.length <= 50) {
      if (Number(horseUser) && Number(horseBox) && Number(boardingHorse)) {
        if (isValidDateFormat(birthdateHorse)) {
          if (isValidURL(imageHorse)) {
            if (coatHorse.length <= 50 || coatHorse == "") {
              if ((heightHorse > 0 && heightHorse < 200) || heightHorse == "") {
                newHorse(
                  nameHorse,
                  imageHorse,
                  birthdateHorse,
                  heightHorse,
                  coatHorse,
                  horseUser,
                  horseBox,
                  boardingHorse
                );
              } else {
                errorMessageHorses.innerHTML =
                  "Merci de renter une taille valide.";
              }
            } else {
              errorMessageHorses.innerHTML =
                "La robe doit faire au maximum 50 caractères.";
            }
          } else {
            errorMessageHorses.innerHTML = "Merci de renter un URL valide.";
          }
        } else {
          errorMessageHorses.innerHTML = "Merci de rentrer une date valide.";
        }
      } else {
        errorMessageHorses.innerHTML = "Merci de selectionner un champ.";
      }
    } else {
      errorMessageHorses.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorses.innerHTML = "Merci de remplir tous les champs.";
  }
}

function newHorse(
  nameHorse,
  imageHorse,
  birthdateHorse,
  heightHorse,
  coatHorse,
  horseUser,
  horseBox,
  boardingHorse
) {
  let newHorse = {
    nameHorse: nameHorse,
    imageHorse: imageHorse,
    birthdateHorse: birthdateHorse,
    heightHorse: heightHorse,
    coatHorse: coatHorse,
    horseUser: horseUser,
    horseBox: horseBox,
    boardingHorse: boardingHorse,
  };
  console.log(newHorse);

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newHorse),
  };

  fetch(HOME_URL + "admin/horses/add", params)
    .then((res) => res.text())
    .then((data) => reponseAddHorse(JSON.parse(data)));
}

function reponseAddHorse(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllHorses();
    closeAddHorseModal();
  } else {
    document.getElementById("errorMessageHorses").innerHTML = data.message;
  }
}

// Edit horse
function getHorseById(idHorse) {
  let horse = {
    idHorse: idHorse,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(horse),
  };

  fetch(HOME_URL + "admin/horses/id", params)
    .then((res) => res.text())
    .then((data) => {
      openEditHorseModal(JSON.parse(data));
    });
}

function closeEditHorseModal() {
  document.querySelector(".modalEditHorse").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openEditHorseModal(horse) {
  getAllUserSelect(horse.id_user);
  getAllBox(horse.id_box);
  getAllBoardingSelect("horse", horse.id_boarding);

  document.querySelector(".modalEditHorse").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".divEditHorse").innerHTML =
    `
 <h3 class="text-2xl text-center mb-8">Modifier ` +
    horse.name_horse +
    `</h3>
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
              <label for="nameHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Nom</label>
              <input type="text" name="nameHorse" id="nameHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    horse.name_horse +
    `' >
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseUser" class='mb-3 block text-base font-medium text-[#07074D]"'>Propriétaire</label>

                <select name="horseUser"  id="horseUserEdit" class="horseUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                </select>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <label for="imageHorse" class='mb-3 block text-base font-medium text-[#07074D]"'>Image</label>
        <input type="text" name="imageHorse" id="imageHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    horse.image_horse +
    ` >
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="birthdateHorse" class='mb-3 block text-base"'>Date de naissance</label>
                <input type="date" name="birthdateHorse" id="birthdateHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    horse.birthdate_horse +
    `>
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="heightHorse" class='mb-3 block text-base'>Taille (en cm)</label>
                <input type="number" min=0 max=200 placeholder="120" name="heightHorse" id="heightHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    isNull(horse.height_horse) +
    `>
            </div>
        </div>
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="coatHorse" class='mb-3 block text-base'>Robe</label>
                <input type="text" name="coatHorse" placeholder="Alezan" id="coatHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    isNull(horse.coat_horse) +
    `>
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseBox" class='mb-3 block text-base"'>Box</label>

                <select name="horseBox" id="horseBoxEdit" class="horseBox w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                </select>
            </div>
        </div>
    </div>
                <div class="mb-5">
                    <label for="boardingHorse" class='mb-3 block text-base'>Pension</label>
                    <select name="boardingHorse" id="boardingHorseEdit" class="boardingHorse w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md">

                    </select>
                </div>


    <div id="errorMessageHorsesEdit"></div>

     <div class="w-fit m-auto mt-8">
         <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editHorseVerification(` +
    horse.id_horse +
    `)">Modifier</button>
     </div>
  `;
}

function editHorseVerification(idHorse) {
  let nameHorseEdit = document.getElementById("nameHorseEdit").value;
  let imageHorseEdit = document.getElementById("imageHorseEdit").value;
  let birthdateHorseEdit = document.getElementById("birthdateHorseEdit").value;
  let horseUserEdit = parseInt(document.getElementById("horseUserEdit").value);
  let heightHorseEdit = document.getElementById("heightHorseEdit").value;
  let coatHorseEdit = document.getElementById("coatHorseEdit").value;
  let horseBoxEdit = parseInt(document.getElementById("horseBoxEdit").value);
  let boardingHorseEdit = parseInt(
    document.getElementById("boardingHorseEdit").value
  );
  let errorMessageHorsesEdit = document.getElementById(
    "errorMessageHorsesEdit"
  );

  if (
    nameHorseEdit !== "" &&
    imageHorseEdit !== "" &&
    birthdateHorseEdit !== "" &&
    horseUserEdit !== "" &&
    horseBoxEdit !== "" &&
    boardingHorseEdit !== ""
  ) {
    if (nameHorseEdit.length <= 50) {
      if (
        (Number(horseUserEdit) &&
          Number(horseBoxEdit) &&
          Number(boardingHorseEdit)) ||
        boardingHorseEdit == 0
      ) {
        if (isValidDateFormat(birthdateHorseEdit)) {
          if (isValidURL(imageHorseEdit)) {
            if (coatHorseEdit.length <= 50 || coatHorseEdit == "") {
              if (
                (heightHorseEdit > 0 && heightHorseEdit < 200) ||
                heightHorseEdit == ""
              ) {
                editHorse(
                  idHorse,
                  nameHorseEdit,
                  imageHorseEdit,
                  birthdateHorseEdit,
                  heightHorseEdit,
                  coatHorseEdit,
                  horseUserEdit,
                  horseBoxEdit,
                  boardingHorseEdit
                );
              } else {
                errorMessageHorsesEdit.innerHTML =
                  "Merci de renter une taille valide.";
              }
            } else {
              errorMessageHorsesEdit.innerHTML =
                "La robe doit faire au maximum 50 caractères.";
            }
          } else {
            errorMessageHorsesEdit.innerHTML = "Merci de renter un URL valide.";
          }
        } else {
          errorMessageHorsesEdit.innerHTML = "Merci de renter une date valide.";
        }
      } else {
        errorMessageHorsesEdit.innerHTML = "Merci de selectionner un champ.";
      }
    } else {
      errorMessageHorsesEdit.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorsesEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editHorse(
  idHorse,
  nameHorse,
  imageHorse,
  birthdateHorse,
  heightHorse,
  coatHorse,
  horseUser,
  horseBox,
  boardingHorse
) {
  let editHorse = {
    idHorse: idHorse,
    nameHorse: nameHorse,
    imageHorse: imageHorse,
    birthdateHorse: birthdateHorse,
    heightHorse: heightHorse,
    coatHorse: coatHorse,
    horseUser: horseUser,
    horseBox: horseBox,
    boardingHorse: boardingHorse,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editHorse),
  };

  fetch(HOME_URL + "admin/horses/edit", params)
    .then((res) => res.text())
    .then((data) => reponseEditHorse(JSON.parse(data)));
}

function reponseEditHorse(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllHorses();
    closeEditHorseModal();
  } else {
    document.getElementById("errorMessageHorsesEdit").innerHTML = data.message;
  }
}

// Delete horse

function openDeleteHorseModal(idHorse, nameHorse) {
  document.querySelector(".modalDeleteHorse").classList.remove("hidden");
  document.querySelector(".deleteHorseMessage").innerHTML =
    `<p>Voulez-vous vraiment suppimer ` +
    nameHorse +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#A16C21] text-white border-2 border-[#A16C21] hover:bg-white hover:text-[#A16C21] rounded-xl font-bold" onclick=deleteHorse(` +
    idHorse +
    `) >Oui</button>
    <button class="p-2 bg-white text-[#A16C21] border-2 border-[#A16C21] hover:bg-[#A16C21] hover:text-white rounded-xl font-bold" onclick=closeDeleteHorseModal() >Non</button>
  </div>
  `;
}

function closeDeleteHorseModal() {
  document.querySelector(".modalDeleteHorse").classList.add("hidden");
}

function deleteHorse(idHorse) {
  let horse = {
    idHorse: idHorse,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(horse),
  };

  fetch(HOME_URL + "admin/horses/delete", params)
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      reponseDeleteHorse(JSON.parse(data));
    });
}

function reponseDeleteHorse(data) {
  openSuccessMessage(data.message);
  getAllHorses();
  closeDeleteHorseModal();
}
