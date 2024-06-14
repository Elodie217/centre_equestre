function getAllUser(idUserHorse = 0) {
  fetch(HOME_URL + "admin/user/all")
    .then((res) => res.text())
    .then((data) => {
      displayUser(JSON.parse(data), idUserHorse);
    });
}

function displayUser(users, idUserHorse) {
  divHorseUser = document.querySelectorAll(".horseUser");
  divHorseUser.forEach((div) => {
    div.innerHTML = "";
  });

  users.forEach((user) => {
    divHorseUser.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        user.id_user +
        ` class='mb-3 block text-base font-medium text-[#07074D]' 
      ` +
        isSelected(idUserHorse, user.id_user) +
        `
      >` +
        user.firstname_user +
        ` ` +
        user.lastname_user +
        ` </option>`;
    });
  });
}
