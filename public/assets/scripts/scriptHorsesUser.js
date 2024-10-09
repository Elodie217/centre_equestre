function getUserHorses() {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "user/horses/byiduser", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayUserHorses(JSON.parse(data));
      }
    });
}

function displayUserHorses(horses) {
  let divUserHorse = document.querySelector(".divUserHorse");
  divUserHorse.innerHTML = ``;

  horses.forEach((horse) => {
    const birthdateHorse = new Date(horse.birthdate_horse);

    divUserHorse.innerHTML +=
      `
    <div class='relative md:flex md:flex-wrap mx-auto md:mx-16 my-16 p-4 sm:p-8 items-center rounded-xl text-left shadow-xl w-fit'>
        <div class=''>
            <img src='` +
      horse.image_horse +
      `' alt='Photo de ` +
      horse.name_horse +
      `' class='max-h-96 max-w-72 sm:max-w-96 w-fit m-auto rounded-xl'>
        </div>

        <div class='ml-8 mt-8'>
            <h3 class="mb-4 font-bold text-2xl">` +
      horse.name_horse +
      `</h3>
            <p class='mb-2'>Date de naissance : ` +
      birthdateHorse.toLocaleDateString("fr") +
      `</p>

            <p class='mb-2'>` +
      isNull(horse.height_horse, "Taille : ", " cm") +
      `</p>

            <p class='mb-2'>Robe : ` +
      isNull(horse.coat_horse) +
      `</p>

            <p class='mb-2 '>` +
      horse.name_box +
      `</p>

            <p class='mb-2 italic'>` +
      isNull(horse.name_boarding) +
      `</p>

            <div class='flex absolute text-xl bottom-4 right-4'>
                <button onclick="getHorseByIdUser(` +
      horse.id_horse +
      `)"><i class="fa-solid fa-pen-to-square mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i> </button>
            </div> 
        </div>
    </div>
    `;
  });
}

//Edit Horse

function getHorseByIdUser(idHorse) {
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

  fetch(HOME_URL + "user/horses/id", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        openEditHorseModalUser(JSON.parse(data));
      }
    });
}

function closeEditHorseModalUser() {
  document.querySelector(".modalEditHorseUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openEditHorseModalUser(horse) {
  getAllUserSelect(horse.id_user);
  getAllBox(horse.id_box);
  getAllBoardingSelect("horse", horse.id_boarding);

  document.querySelector(".modalEditHorseUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  let nameImageHorse = horse.image_horse.split("/").pop();

  document.getElementById("h3EditHorseUser").innerText =
    "Modifier " + horse.name_horse;
  document.getElementById("nameHorseEditUser").value = horse.name_horse;
  document.getElementById("previewimageHorseEditUser").src = horse.image_horse;
  document.getElementById("birthdateHorseEditUser").value =
    horse.birthdate_horse;
  document.getElementById("heightHorseEditUser").value = isNull(
    horse.height_horse
  );
  document.getElementById("coatHorseEditUser").value = isNull(horse.coat_horse);
  document.getElementById("btnEditHorseVerificationUser").innerHTML =
    `<button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editHorseVerificationUser(` +
    horse.id_horse +
    `, '` +
    nameImageHorse +
    `')">Modifier</button>`;
}

let imageHorseEditUser = document.getElementById("imageHorseEditUser");

imageHorseEditUser.addEventListener("change", function (event) {
  imageHorseEditUser = event.target.files;

  document.getElementById("errorMessageHorsesEditUser").innerHTML = "";

  if (imageHorseEditUser.length > 0) {
    let file = imageHorseEditUser[0];
    if (
      file.type == "image/png" ||
      file.type == "image/jpeg" ||
      file.type == "image/jpg" ||
      file.type == "image/svg"
    ) {
      document.getElementById("previewimageHorseEditUser").src =
        URL.createObjectURL(file);
    } else {
      document.getElementById("errorMessageHorsesEditUser").innerHTML =
        "Les formats d'image accepté sont : png, jpeg, jpg et svg";
    }
  }
});

function editHorseVerificationUser(idHorse, nameImageHorse) {
  let nameHorseEdit = document.getElementById("nameHorseEditUser").value;
  let birthdateHorseEdit = document.getElementById(
    "birthdateHorseEditUser"
  ).value;
  let heightHorseEdit = document.getElementById("heightHorseEditUser").value;
  let coatHorseEdit = document.getElementById("coatHorseEditUser").value;

  let errorMessageHorsesEdit = document.getElementById(
    "errorMessageHorsesEditUser"
  );

  let DateNow = Date.now();

  let bDate = new Date(birthdateHorseEdit);

  const maxSizeImage = 2 * 1024 * 1024;

  if (imageHorseEditUser.length == 1) {
    if (
      imageHorseEditUser[0].type == "image/png" ||
      imageHorseEditUser[0].type == "image/jpeg" ||
      imageHorseEditUser[0].type == "image/jpg" ||
      imageHorseEditUser[0].type == "image/svg"
    ) {
      if (imageHorseEditUser[0].size <= maxSizeImage) {
        imageHorseEditUser = imageHorseEditUser[0];
      } else {
        errorMessageHorsesEdit.innerHTML = "L'image de doit pas dépasser 2Mo.";
        return;
      }
    } else {
      errorMessageHorsesEdit.innerHTML =
        "Les formats d'image accepté sont : png, jpeg, jpg et svg.";
      return;
    }
  } else if (imageHorseEditUser > 1) {
    errorMessageHorsesEdit.innerHTML = "Une seule image est acceptée.";
    return;
  } else {
    imageHorseEditUser = document.getElementById(
      "previewimageHorseEditUser"
    ).src;
  }

  if (nameHorseEdit !== "" && birthdateHorseEdit !== "") {
    if (nameHorseEdit.length <= 50) {
      if (isValidDateFormat(birthdateHorseEdit) && DateNow > bDate.getTime()) {
        if (coatHorseEdit.length <= 50 || coatHorseEdit == "") {
          if (
            (heightHorseEdit > 0 && heightHorseEdit < 200) ||
            heightHorseEdit == ""
          ) {
            let formDataEditUser = new FormData();

            formDataEditUser.append("idHorse", idHorse);
            formDataEditUser.append("nameImageHorse", nameImageHorse);
            formDataEditUser.append("nameHorse", nameHorseEdit);
            formDataEditUser.append("birthdateHorse", birthdateHorseEdit);
            formDataEditUser.append("heightHorse", heightHorseEdit);
            formDataEditUser.append("coatHorse", coatHorseEdit);
            formDataEditUser.append("imageHorse", imageHorseEditUser);

            editHorseUser(formDataEditUser);
          } else {
            errorMessageHorsesEdit.innerHTML =
              "Merci de renter une taille valide.";
          }
        } else {
          errorMessageHorsesEdit.innerHTML =
            "La robe doit faire au maximum 50 caractères.";
        }
      } else {
        errorMessageHorsesEdit.innerHTML = "Merci de renter une date valide.";
      }
    } else {
      errorMessageHorsesEdit.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorsesEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editHorseUser(formDataEditUser) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
    },
    body: formDataEditUser,
  };

  fetch(HOME_URL + "user/horses/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditHorseUSer(JSON.parse(data));
      }
    });
}

function reponseEditHorseUSer(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getUserHorses();
    closeEditHorseModalUser();
  } else {
    document.getElementById("errorMessageHorsesEditUser").innerHTML =
      data.message;
  }
}
