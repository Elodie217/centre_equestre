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
          console.log(data);

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
  <article class="bg-white h-fit p-8 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl border relative">
    
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
      isNull(horse.height_horse, "Taille (en cm) : ") +
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
      `', '` +
      horse.image_horse +
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

let imageHorse = document.getElementById("imageHorse");

imageHorse.addEventListener("change", function (event) {
  imageHorse = event.target.files;

  document.getElementById("errorMessageHorses").innerHTML = "";

  if (imageHorse.length > 0) {
    let file = imageHorse[0];
    if (
      file.type == "image/png" ||
      file.type == "image/jpeg" ||
      file.type == "image/jpg" ||
      file.type == "image/svg"
    ) {
      document.getElementById("previewImageHorse").src =
        URL.createObjectURL(file);
    } else {
      document.getElementById("errorMessageHorses").innerHTML =
        "Les formats d'image accepté sont : png, jpeg, jpg et svg";
    }
  }
});

function newHorseVerification() {
  let nameHorse = document.getElementById("nameHorse").value;
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

  const maxSizeImage = 2 * 1024 * 1024;

  if (
    nameHorse !== "" &&
    imageHorse.length == 1 &&
    birthdateHorse !== "" &&
    horseUser !== "" &&
    horseBox !== "" &&
    boardingHorse !== ""
  ) {
    if (nameHorse.length <= 50) {
      if (horseUser > 0 && horseBox > 0 && boardingHorse >= 0) {
        if (isValidDateFormat(birthdateHorse) && DateNow > bDate.getTime()) {
          // if (isValidURL(imageHorse)) {
          if (
            imageHorse[0].type == "image/png" ||
            imageHorse[0].type == "image/jpeg" ||
            imageHorse[0].type == "image/jpg" ||
            imageHorse[0].type == "image/svg"
          ) {
            if (imageHorse[0].size < maxSizeImage) {
              if (coatHorse.length <= 50 || coatHorse == "") {
                if (
                  (heightHorse > 0 && heightHorse < 200) ||
                  heightHorse == ""
                ) {
                  let formData = new FormData();
                  formData.append("nameHorse", nameHorse);
                  formData.append("birthdateHorse", birthdateHorse);
                  formData.append("heightHorse", heightHorse);
                  formData.append("coatHorse", coatHorse);
                  formData.append("horseUser", horseUser);
                  formData.append("horseBox", horseBox);
                  formData.append("boardingHorse", boardingHorse);
                  formData.append("imageHorse", imageHorse[0]);

                  newHorse(formData);
                } else {
                  errorMessageHorses.innerHTML =
                    "Merci de renter une taille valide.";
                }
              } else {
                errorMessageHorses.innerHTML =
                  "La robe doit faire au maximum 50 caractères.";
              }
            } else {
              errorMessageHorses.innerHTML =
                "L'image de doit pas dépasser 2Mo.";
            }
          } else {
            errorMessageHorses.innerHTML =
              "Les formats d'image accepté sont : png, jpeg, jpg et svg";
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

function newHorse(formData) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
    },
    body: formData,
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
  getAllUserSelect(horse.id_user);
  getAllBox(horse.id_box);
  getAllBoardingSelect("horse", horse.id_boarding);

  document.querySelector(".modalEditHorse").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  let nameImageHorse = horse.image_horse.split("/").pop();

  document.getElementById("h3EditHorse").innerText =
    "Modifier " + horse.name_horse;
  document.getElementById("nameHorseEdit").value = horse.name_horse;
  document.getElementById("previewImageHorseEdit").src = horse.image_horse;
  document.getElementById("birthdateHorseEdit").value = horse.birthdate_horse;
  document.getElementById("heightHorseEdit").value = isNull(horse.height_horse);
  document.getElementById("coatHorseEdit").value = isNull(horse.coat_horse);
  document.getElementById("btnEditHorseVerification").innerHTML =
    `<button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editHorseVerification(` +
    horse.id_horse +
    `, '` +
    nameImageHorse +
    `')">Modifier</button>`;
}

let imageHorseEdit = document.getElementById("imageHorseEdit");

imageHorseEdit.addEventListener("change", function (event) {
  imageHorseEdit = event.target.files;

  document.getElementById("errorMessageHorses").innerHTML = "";

  if (imageHorseEdit.length > 0) {
    let file = imageHorseEdit[0];
    if (
      file.type == "image/png" ||
      file.type == "image/jpeg" ||
      file.type == "image/jpg" ||
      file.type == "image/svg"
    ) {
      document.getElementById("previewImageHorseEdit").src =
        URL.createObjectURL(file);
    } else {
      document.getElementById("errorMessageHorsesEdit").innerHTML =
        "Les formats d'image accepté sont : png, jpeg, jpg et svg";
    }
  }
});

function editHorseVerification(idHorse, nameImageHorse) {
  let nameHorseEdit = document.getElementById("nameHorseEdit").value;
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

  const maxSizeImage = 2 * 1024 * 1024;

  if (imageHorseEdit.length == 1) {
    if (
      imageHorseEdit[0].type == "image/png" ||
      imageHorseEdit[0].type == "image/jpeg" ||
      imageHorseEdit[0].type == "image/jpg" ||
      imageHorseEdit[0].type == "image/svg"
    ) {
      if (imageHorseEdit[0].size <= maxSizeImage) {
        console.log(imageHorseEdit);

        imageHorseEdit = imageHorseEdit[0];
      } else {
        errorMessageHorsesEdit.innerHTML = "L'image de doit pas dépasser 2Mo.";
        return;
      }
    } else {
      errorMessageHorsesEdit.innerHTML =
        "Les formats d'image accepté sont : png, jpeg, jpg et svg.";
      return;
    }
  } else if (imageHorseEdit > 1) {
    errorMessageHorsesEdit.innerHTML = "Une seule image est acceptée.";
    return;
  } else {
    imageHorseEdit = document.getElementById("previewImageHorseEdit").src;
  }

  if (
    nameHorseEdit !== "" &&
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
          if (coatHorseEdit.length <= 50 || coatHorseEdit == "") {
            if (
              (heightHorseEdit > 0 && heightHorseEdit < 200) ||
              heightHorseEdit == ""
            ) {
              let formDataEdit = new FormData();

              formDataEdit.append("idHorse", idHorse);
              formDataEdit.append("nameImageHorse", nameImageHorse);
              formDataEdit.append("nameHorse", nameHorseEdit);
              formDataEdit.append("birthdateHorse", birthdateHorseEdit);
              formDataEdit.append("heightHorse", heightHorseEdit);
              formDataEdit.append("coatHorse", coatHorseEdit);
              formDataEdit.append("horseUser", horseUserEdit);
              formDataEdit.append("horseBox", horseBoxEdit);
              formDataEdit.append("boardingHorse", boardingHorseEdit);
              formDataEdit.append("imageHorse", imageHorseEdit);

              editHorse(formDataEdit);
            } else {
              errorMessageHorsesEdit.innerHTML =
                "Merci de renter une taille valide.";
            }
          } else {
            errorMessageHorsesEdit.innerHTML =
              "La robe doit faire au maximum 50 caractères.";
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

function editHorse(formDataEdit) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
    },
    body: formDataEdit,
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

function openDeleteHorseModal(idHorse, nameHorse, linkImageHorse) {
  document.querySelector(".modalDeleteHorse").classList.remove("hidden");
  document.querySelector(".deleteHorseMessage").innerHTML =
    `<p>Voulez-vous vraiment suppimer ` +
    nameHorse +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick="deleteHorse(` +
    idHorse +
    `, '` +
    linkImageHorse +
    `')" >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDeleteHorseModal() >Non</button>
  </div>
  `;
}

function closeDeleteHorseModal() {
  document.querySelector(".modalDeleteHorse").classList.add("hidden");
}

function deleteHorse(idHorse, linkImageHorse) {
  let horse = {
    idHorse: idHorse,
    linkImageHorse: linkImageHorse,
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
