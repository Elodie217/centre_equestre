function getAllBoardingSelect(divDisplay = "boarding", idBoardingGiven = 0) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/boarding/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        if (divDisplay == "boarding") {
          displayBoarding(JSON.parse(data));
        } else if (divDisplay == "horse") {
          displayBoardingSelect(JSON.parse(data), idBoardingGiven);
        }
      }
    });
}

function displayBoardingSelect(allBording, idBoardingGiven) {
  let divHorseBoarding = document.querySelectorAll(".boardingHorse");
  divHorseBoarding.forEach((div) => {
    div.innerHTML =
      "<option value=0 class='mb-3 block text-base font-medium  '>Aucune</option>";
  });

  allBording.forEach((boarding) => {
    divHorseBoarding.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        boarding.id_boarding +
        ` class='mb-3 block text-base font-medium  ' 
      ` +
        isSelected(idBoardingGiven, boarding.id_boarding) +
        `
      >` +
        boarding.name_boarding +
        ` </option>`;
    });
  });
}

function displayBoarding(data) {
  let divBoarding = document.querySelector(".divBoarding");

  divBoarding.innerHTML = "";

  data.forEach((boarding) => {
    divBoarding.innerHTML +=
      `
 <div class='relative bg-white h-fit px-6 pt-8 pb-10 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border relative'>
    
     <button onclick="getBoardingHorses(` +
      boarding.id_boarding +
      `, '` +
      boarding.name_boarding +
      `')" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></button>

      <h4 class='text-3xl text-[#64832F] break-words'>` +
      boarding.name_boarding +
      `</h4>
    <div class="grid grid-cols-3 grid-rows-2 w-fit mx-auto mt-10">
        <div class='text-6xl col-span-2 text-right'>` +
      boarding.price_boarding +
      `</div>
        <div class='text-5xl text-left col-start-3'>€</div>
        <div class="text-sm col-start-2 row-start-2 text-right">par mois</div>
    </div>
    <p><i class="text-[#64832F] fa-solid fa-check"></i> ` +
      boarding.service_boarding +
      `</p>
    <p>` +
      service2Existe(boarding.service2_boarding) +
      `</p>

      <div class='flex absolute text-xl bottom-4 right-4'>
        <button onclick="getBoardingById(` +
      boarding.id_boarding +
      `)"><i class="fa-solid fa-pen-to-square mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i> </button>
      </div>
  </div>`;
  });
}

function service2Existe(data) {
  if (data !== null) {
    return '<i class="text-[#64832F] fa-solid fa-check"></i> ' + data;
  } else {
    return "";
  }
}

function getBoardingHorses(id, name, price) {
  console.log(id, name, price);
}

function getBoardingHorses(idBoarding, nameBoarding) {
  let boarding = {
    idBoarding: idBoarding,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(boarding),
  };

  fetch(HOME_URL + "admin/boarding/horse", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayBoardingHorse(nameBoarding, JSON.parse(data));
        console.log(JSON.parse(data));
      }
    });
}

function displayBoardingHorse(nameBoarding, horses) {
  document.querySelector(".modalViewBoarding").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".divViewBoarding").innerHTML =
    `
    <h3 class="text-2xl text-center mb-8 font-bold">` +
    nameBoarding +
    `</h3>

    <p class='font-bold mb-4'> Les pensionnaires : </p>
    <p>` +
    horses
      .map(
        (horse) =>
          horse.name_horse +
          " - " +
          horse.firstname_user +
          " " +
          horse.lastname_user
      )
      .join(", </br>") +
    `
    </p>
  `;
}

function closeViewBoardingModal() {
  document.querySelector(".modalViewBoarding").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

// Edit boarding

function getBoardingById(idBoarding) {
  let boarding = {
    idBoarding: idBoarding,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(boarding),
  };

  fetch(HOME_URL + "admin/boarding/id", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        openEditBoardingModal(JSON.parse(data));
      }
    });
}

function closeEditBoardingModal() {
  document.querySelector(".modalEditBoarding").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openEditBoardingModal(boarding) {
  document.querySelector(".modalEditBoarding").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  console.log("boarding", boarding.service2_boarding);

  console.log("isNull", isNull(boarding.service2_boarding));

  document.querySelector(".divEditBoarding").innerHTML =
    `
 <h3 class="text-2xl text-center mb-8">Modifier ` +
    boarding.name_boarding +
    `</h3>
   
    <div class="mb-5">
        <label for="nameBoarding" class='mb-3 block text-base font-medium  "'>Nom *</label>
        <input type="text" name="nameBoarding" id="nameBoardingEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="` +
    boarding.name_boarding +
    `" >
    </div>

    <div class="mb-5">
        <label for="priceBoarding" class='mb-3 block text-base font-medium  "'>Prix (en €) *</label>
        <input type="number" min=0 max=2000 placeholder="420" name="priceBoarding" id="priceBoardingEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    boarding.price_boarding +
    ` >
    </div>
    
    <div class="mb-5">
        <label for="serviceBoarding" class='mb-3 block text-base font-medium  "'>Service *</label>
        <input type="text" name="serviceBoarding" id="serviceBoardingEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="` +
    boarding.service_boarding +
    `" >
    </div>
    
    <div class="mb-5">
        <input type="text" name="serviceBisBoarding" id="serviceBisBoardingEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value="` +
    isNull(boarding.service2_boarding) +
    `" >
    </div>

    <div id="errorMessageBoardingsEdit" class="text-[#ff2727]"></div>

     <div class="w-fit m-auto mt-8">
         <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editBoardingVerification(` +
    boarding.id_boarding +
    `)">Modifier</button>
     </div>
  `;
}

function editBoardingVerification(idBoarding) {
  let nameBoardingEdit = document.getElementById("nameBoardingEdit").value;
  let priceBoardingEdit = document.getElementById("priceBoardingEdit").value;
  let serviceBoardingEdit = document.getElementById(
    "serviceBoardingEdit"
  ).value;
  let serviceBisBoardingEdit = document.getElementById(
    "serviceBisBoardingEdit"
  ).value;

  let errorMessageBoardingsEdit = document.getElementById(
    "errorMessageBoardingsEdit"
  );

  console.log(serviceBisBoardingEdit);

  if (
    nameBoardingEdit !== "" &&
    priceBoardingEdit !== "" &&
    serviceBoardingEdit !== ""
  ) {
    if (nameBoardingEdit.length <= 255) {
      if (serviceBoardingEdit.length <= 255) {
        if (
          serviceBisBoardingEdit.length <= 255 ||
          serviceBisBoardingEdit == ""
        ) {
          if (priceBoardingEdit > 0 && priceBoardingEdit < 2000) {
            editBoarding(
              idBoarding,
              nameBoardingEdit,
              priceBoardingEdit,
              serviceBoardingEdit,
              serviceBisBoardingEdit
            );
          } else {
            errorMessageBoardingsEdit.innerHTML =
              "Merci de renter un prix valide.";
          }
        } else {
          errorMessageBoardingsEdit.innerHTML =
            "Le service doit faire au maximum 255 caractères.";
        }
      } else {
        errorMessageBoardingsEdit.innerHTML =
          "Le service doit faire au maximum 255 caractères.";
      }
    } else {
      errorMessageBoardingsEdit.innerHTML =
        "Le nom doit faire au maximum 255 caractères.";
    }
  } else {
    errorMessageBoardingsEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editBoarding(
  idBoarding,
  nameBoardingEdit,
  priceBoardingEdit,
  serviceBoardingEdit,
  serviceBisBoardingEdit
) {
  let editBoarding = {
    idBoarding: idBoarding,
    nameBoardingEdit: nameBoardingEdit,
    priceBoardingEdit: priceBoardingEdit,
    serviceBoardingEdit: serviceBoardingEdit,
    serviceBisBoardingEdit: serviceBisBoardingEdit,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editBoarding),
  };

  fetch(HOME_URL + "admin/boarding/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditBoarding(JSON.parse(data));
      }
    });
}

function reponseEditBoarding(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllBoardingSelect();
    closeEditBoardingModal();
  } else {
    document.getElementById("errorMessageBoardingEdit").innerHTML =
      data.message;
  }
}
