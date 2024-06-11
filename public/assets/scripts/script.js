function openModal() {
  console.log("essaie btn");
}

function newHorseVerification() {
  let nameHorse = document.getElementById("nameHorse").value;
  let imageHorse = document.getElementById("imageHorse").value;
  let breedHorse = document.getElementById("breedHorse").value;
  let horseUser = document.getElementById("horseUser").value;
  let horseBox = document.getElementById("horseBox").value;
  let errorMessageHorses = document.getElementById("errorMessageHorses");

  if (
    nameHorse !== "" &&
    imageHorse !== "" &&
    breedHorse !== "" &&
    horseUser !== "" &&
    horseBox !== ""
  ) {
    if (nameHorse.length <= 50) {
      if (Number(horseUser) && Number(horseBox)) {
        if (breedHorse.length <= 50) {
          newHorse(nameHorse, imageHorse, breedHorse, horseUser, horseBox);
        } else {
          errorMessageHorses.innerHTML =
            "La race doit faire au maximum 50 caractères.";
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

function newHorse(nameHorse, imageHorse, breedHorse, horseUser, horseBox) {
  let newHorse = {
    nameHorse: nameHorse,
    imageHorse: imageHorse,
    breedHorse: breedHorse,
    horseUser: horseUser,
    horseBox: horseBox,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newHorse),
  };

  fetch(HOME_URL + "horses/add", params)
    .then((res) => res.text())
    .then((data) => reponseInscription(JSON.parse(data)));
}
