function getAllBoardingSelect(divDisplay = "boarding", idBoardingGiven = 0) {
  fetch(HOME_URL + "admin/boarding/all")
    .then((res) => res.text())
    .then((data) => {
      if (divDisplay == "boarding") {
        displayBoarding(JSON.parse(data));
      } else if (divDisplay == "horse") {
        displayBoardingSelect(JSON.parse(data), idBoardingGiven);
      }
    });
}

function displayBoardingSelect(allBording, idBoardingGiven) {
  let divHorseBoarding = document.querySelectorAll(".boardingHorse");
  divHorseBoarding.forEach((div) => {
    div.innerHTML =
      "<option value=0 class='mb-3 block text-base font-medium text-[#07074D]'>Aucune</option>";
  });

  allBording.forEach((boarding) => {
    divHorseBoarding.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        boarding.id_boarding +
        ` class='mb-3 block text-base font-medium text-[#07074D]' 
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

  data.forEach((boarding) => {
    divBoarding.innerHTML +=
      `
 <div class='relative bg-white h-fit px-6 pt-8 pb-10 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border relative'>
    
     <button onclick="getBoardingHorses(` +
      boarding.id_boarding +
      `, '` +
      boarding.name_boarding +
      `')" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></button>

      <h4 class='text-3xl text-[#64832F]'>` +
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
        <button onclick="getBoardingHorses(` +
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

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(boarding),
  };

  fetch(HOME_URL + "admin/boarding/id", params)
    .then((res) => res.text())
    .then((data) => {
      displayBoardingHorse(nameBoarding, JSON.parse(data));
      console.log(JSON.parse(data));
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
