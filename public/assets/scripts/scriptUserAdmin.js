function getAllUser(idUserHorse = 0, div = "select") {
  fetch(HOME_URL + "admin/user/all")
    .then((res) => res.text())
    .then((data) => {
      if (div == "select") {
        displayUser(JSON.parse(data), idUserHorse);
      } else if (div == "checkbox") {
        displayUserCheckbox(JSON.parse(data));
      }
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

function displayUserCheckbox(users) {
  divLessonUser = document.querySelectorAll(".lessonUser");
  divLessonUser.forEach((div) => {
    div.innerHTML = "";
  });

  users.forEach((user) => {
    divLessonUser.forEach((div) => {
      div.innerHTML +=
        `
      <div>
        <input type="checkbox" id="" class="userLessonAdd" value=` +
        user.id_user +
        ` name="` +
        user.firstname_user +
        `.` +
        user.lastname_user +
        `" />
        <label for="` +
        user.firstname_user +
        `.` +
        user.lastname_user +
        `">` +
        user.firstname_user +
        ` ` +
        user.lastname_user +
        `</label>
        </div>`;
      // isSelected(idUserHorse, user.id_user) +
    });
  });
}
