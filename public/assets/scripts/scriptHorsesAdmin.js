function getAllHorses(divDisplay = "horse", idHorse = 0) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/horses/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        if (divDisplay == "horse") {
          displayHorses(JSON.parse(data));
        } else if (divDisplay == "box") {
          displayBoxHorses(JSON.parse(data), idHorse);
        }
      }
    });
}

function displayBoxHorses(horses, idHorse) {
  divBoxHorse = document.querySelector("#boxHorseEdit");
  divBoxHorse.innerHTML +=
    `
      <option value=0 class='mb-3 block text-base font-medium  ' 
      ` +
    isSelected(idHorse, 0) +
    ` ></option>`;
  horses.forEach((element) => {
    divBoxHorse.innerHTML +=
      `
      <option value=` +
      element.id_horse +
      ` class='mb-3 block text-base font-medium  ' 
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

      <p class='mb-2 text-base'>` +
      isNull(horse.height_horse, "Taille (en cm) :") +
      `</p>

      <p class='mb-3 text-base'>` +
      isNull(horse.coat_horse, "Robe : ") +
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
  let horseUser = document.getElementById("horseUserAdd").value;
  let heightHorse = document.getElementById("heightHorse").value;
  let coatHorse = document.getElementById("coatHorse").value;
  let horseBox = document.getElementById("horseBoxAdd").value;
  let boardingHorse = document.getElementById("boardingHorse").value;
  let errorMessageHorses = document.getElementById("errorMessageHorses");
  errorMessageHorses.innerHTML = "";

  let DateNow = Date.now();

  let bDate = new Date(birthdateHorse);

  if (
    nameHorse !== "" &&
    imageHorse !== "" &&
    birthdateHorse !== "" &&
    horseUser !== "" &&
    horseBox !== "" &&
    boardingHorse !== ""
  ) {
    if (nameHorse.length <= 50) {
      if (horseUser > 0 && horseBox > 0 && boardingHorse >= 0) {
        if (isValidDateFormat(birthdateHorse) && DateNow > bDate.getTime()) {
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
          errorMessageHorses.innerHTML =
            "Merci de rentrer une date antérieure à aujourd'hui.";
        }
      } else {
        errorMessageHorses.innerHTML = "Merci de selectionner un champ.";
      }
    } else {
      errorMessageHorses.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorses.innerHTML = "Merci de remplir tous les champs.*";
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newHorse),
  };

  fetch(HOME_URL + "admin/horses/add", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseAddHorse(JSON.parse(data));
      }
    });
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(horse),
  };

  fetch(HOME_URL + "admin/horses/id", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        openEditHorseModal(JSON.parse(data));
      }
    });
}

function closeEditHorseModal() {
  document.querySelector(".modalEditHorse").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openEditHorseModal(horse) {
  console.log("horse edit", horse.id_user, horse.id_box, horse.id_boarding);
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
    <div class="-mx-3 flex flex-wrap font-medium ">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
              <label for="nameHorse" class='mb-3 block text-base  "'>Nom*</label>
              <input type="text" name="nameHorse" id="nameHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    horse.name_horse +
    `' >
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseUser" class='mb-3 block text-base  "'>Propriétaire*</label>

                <select name="horseUser"  id="horseUserEdit" class="horseUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                </select>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <label for="imageHorse" class='mb-3 block text-base  "'>Image*</label>
        <input type="text" name="imageHorse" id="imageHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    horse.image_horse +
    ` >
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="birthdateHorse" class='mb-3 block text-base"'>Date de naissance*</label>
                <input type="date" name="birthdateHorse" id="birthdateHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    horse.birthdate_horse +
    `>
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="heightHorse" class='mb-3 block text-base'>Taille (en cm)</label>
                <input type="number" min=0 max=200 placeholder="120" name="heightHorse" id="heightHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    isNull(horse.height_horse) +
    `>
            </div>
        </div>
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="coatHorse" class='mb-3 block text-base'>Robe</label>
                <input type="text" name="coatHorse" placeholder="Alezan" id="coatHorseEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    isNull(horse.coat_horse) +
    `>
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="horseBox" class='mb-3 block text-base"'>Box*</label>

                <select name="horseBox" id="horseBoxEdit" class="horseBox w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                </select>
            </div>
        </div>
    </div>
                <div class="mb-5">
                    <label for="boardingHorse" class='mb-3 block text-base'>Pension*</label>
                    <select name="boardingHorse" id="boardingHorseEdit" class="boardingHorse w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#C0DF85] focus:shadow-md">

                    </select>
                </div>


    <div id="errorMessageHorsesEdit" class="text-[#ff2727]"></div>

     <div class="w-fit m-auto mt-8">
         <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editHorseVerification(` +
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

  let DateNow = Date.now();

  let bDate = new Date(birthdateHorseEdit);

  if (
    nameHorseEdit !== "" &&
    imageHorseEdit !== "" &&
    birthdateHorseEdit !== "" &&
    horseUserEdit !== "" &&
    horseBoxEdit !== "" &&
    boardingHorseEdit !== ""
  ) {
    if (nameHorseEdit.length <= 50) {
      if (horseUserEdit > 0 && horseBoxEdit > 0 && boardingHorseEdit >= 0) {
        if (
          isValidDateFormat(birthdateHorseEdit) &&
          DateNow > bDate.getTime()
        ) {
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
          errorMessageHorsesEdit.innerHTML =
            "Merci de rentrer une date antérieure à aujourd'hui.";
        }
      } else {
        errorMessageHorsesEdit.innerHTML = "Merci de selectionner un champ.";
      }
    } else {
      errorMessageHorsesEdit.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorsesEdit.innerHTML = "Merci de remplir tous les champs.*";
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editHorse),
  };

  fetch(HOME_URL + "admin/horses/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditHorse(JSON.parse(data));
      }
    });
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
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick=deleteHorse(` +
    idHorse +
    `) >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDeleteHorseModal() >Non</button>
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(horse),
  };

  fetch(HOME_URL + "admin/horses/delete", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseDeleteHorse(JSON.parse(data));
      }
    });
}

function reponseDeleteHorse(data) {
  openSuccessMessage(data.message);
  getAllHorses();
  closeDeleteHorseModal();
}
