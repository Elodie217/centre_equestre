function getAllBoardingSelect(idBoardingGiven = 0) {
  fetch(HOME_URL + "admin/boarding/all")
    .then((res) => res.text())
    .then((data) => {
      displayBoardingSelect(JSON.parse(data), idBoardingGiven);
    });
}

function displayBoardingSelect(allBording, idBoardingGiven) {
  divHorseBoarding = document.querySelectorAll(".boardingHorse");
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
