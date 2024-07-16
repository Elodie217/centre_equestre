function getUserHorses() {
  fetch(HOME_URL + "user/horses/byiduser")
    .then((res) => res.text())
    .then((data) => {
      displayUserHorses(JSON.parse(data));
    });
}

function displayUserHorses(horses) {
  console.log(horses);

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

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(horse),
  };

  fetch(HOME_URL + "user/horses/id", params)
    .then((res) => res.text())
    .then((data) => {
      openEditHorseModalUser(JSON.parse(data));
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

  document.querySelector(".divEditHorseUser").innerHTML =
    `
 <h3 class="text-2xl text-center mb-8">Modifier ` +
    horse.name_horse +
    `</h3>
    <div class="-mx-3 flex flex-wrap font-medium">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
              <label for="nameHorse" class='mb-3 block text-base text-[#07074D]"'>Nom</label>
              <input type="text" name="nameHorse" id="nameHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    horse.name_horse +
    `' >
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="birthdateHorse" class='mb-3 block text-base"'>Date de naissance</label>
                <input type="date" name="birthdateHorse" id="birthdateHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    horse.birthdate_horse +
    `>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <label for="imageHorse" class='mb-3 block text-base text-[#07074D]"'>Image</label>
        <input type="text" name="imageHorse" id="imageHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    horse.image_horse +
    ` >
    </div>

    <div class="-mx-3 flex flex-wrap">
    
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="heightHorse" class='mb-3 block text-base'>Taille (en cm)</label>
                <input type="number" min=0 max=200 placeholder="120" name="heightHorse" id="heightHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    isNull(horse.height_horse) +
    `>
            </div>
        </div>
    
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="coatHorse" class='mb-3 block text-base'>Robe</label>
                <input type="text" name="coatHorse" placeholder="Alezan" id="coatHorseEditUser" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    isNull(horse.coat_horse) +
    `>
            </div>
        </div>
        
    </div>
                

    <div id="errorMessageHorsesEditUser"></div>

     <div class="w-fit m-auto mt-8">
         <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editHorseVerificationUser(` +
    horse.id_horse +
    `)">Modifier</button>
     </div>
  `;
}

function editHorseVerificationUser(idHorse) {
  let nameHorseEdit = document.getElementById("nameHorseEditUser").value;
  let imageHorseEdit = document.getElementById("imageHorseEditUser").value;
  let birthdateHorseEdit = document.getElementById(
    "birthdateHorseEditUser"
  ).value;
  let heightHorseEdit = document.getElementById("heightHorseEditUser").value;
  let coatHorseEdit = document.getElementById("coatHorseEditUser").value;

  let errorMessageHorsesEdit = document.getElementById(
    "errorMessageHorsesEditUser"
  );

  if (
    nameHorseEdit !== "" &&
    imageHorseEdit !== "" &&
    birthdateHorseEdit !== ""
  ) {
    if (nameHorseEdit.length <= 50) {
      if (isValidDateFormat(birthdateHorseEdit)) {
        if (isValidURL(imageHorseEdit)) {
          if (coatHorseEdit.length <= 50 || coatHorseEdit == "") {
            if (
              (heightHorseEdit > 0 && heightHorseEdit < 200) ||
              heightHorseEdit == ""
            ) {
              editHorseUser(
                idHorse,
                nameHorseEdit,
                imageHorseEdit,
                birthdateHorseEdit,
                heightHorseEdit,
                coatHorseEdit
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
      errorMessageHorsesEdit.innerHTML =
        "Le nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageHorsesEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editHorseUser(
  idHorse,
  nameHorse,
  imageHorse,
  birthdateHorse,
  heightHorse,
  coatHorse
) {
  let editHorse = {
    idHorse: idHorse,
    nameHorse: nameHorse,
    imageHorse: imageHorse,
    birthdateHorse: birthdateHorse,
    heightHorse: heightHorse,
    coatHorse: coatHorse,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editHorse),
  };

  fetch(HOME_URL + "user/horses/edit", params)
    .then((res) => res.text())
    .then((data) => reponseEditHorseUSer(JSON.parse(data)));
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
