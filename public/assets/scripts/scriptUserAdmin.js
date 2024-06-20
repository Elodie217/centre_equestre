function getAllUserSelect(idUserGiven = 0, div = "select", action = "add") {
  fetch(HOME_URL + "admin/users/all")
    .then((res) => res.text())
    .then((data) => {
      if (div == "select") {
        displayUserSelect(JSON.parse(data), idUserGiven);
      } else if (div == "checkbox") {
        displayUserSelectCheckbox(JSON.parse(data), idUserGiven, action);
      }
    });
}

function displayUserSelect(users, idUserHorse) {
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

function displayUserSelectCheckbox(users, idUserLesson, action) {
  let divLessonUser;
  if (action == "add") {
    divLessonUser = document.querySelectorAll(".lessonUser");
  } else {
    divLessonUser = document.querySelectorAll(".divLessonUserEdit");
  }

  // divLessonUser = document.querySelectorAll(".lessonUser");
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
        `" ` +
        isCheckedUser(idUserLesson, user.id_user) +
        `/>
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
    });
  });
}

function isCheckedUser(idUsersGiven, idUserBdd) {
  if (idUsersGiven !== 0) {
    let idUsers = idUsersGiven.split(", ");
    let isChecked = "";

    idUsers.forEach((idUser) => {
      let idUserGiven = idUser.split(" ")[0];
      if (idUserGiven == idUserBdd) {
        isChecked = "checked";
      }
    });

    return isChecked;
  }
}

// Display Users
getAllUser();
function getAllUser() {
  fetch(HOME_URL + "admin/users/all")
    .then((res) => res.text())
    .then((data) => {
      displayUser(JSON.parse(data));
    });
}

function displayUser(usersData) {
  document.querySelector(".tbodyUser").innerHTML += "";

  usersData.forEach((userData) => {
    document.querySelector(".tbodyUser").innerHTML +=
      `
      <tr class="border-b hover:bg-neutral-100">
        <td class="px-6 py-4">` +
      userData.lastname_user +
      `</td>
        <td class="px-6 py-4">` +
      userData.firstname_user +
      `</td>
        <td class="px-6 py-4">` +
      userData.email_user +
      `</td>
        <td class="px-6 py-4">` +
      userData.phone_user +
      `</td>
        <td class="px-6 py-4">` +
      userData.role_user +
      `</td>
        <td class="px-6 py-4">` +
      isNull(userData.name_level) +
      `</td>
        <td class="px-6 py-4">
          <button onclick="openViewUserModal(` +
      userData.id_user +
      `)">
            <i class="fa-solid fa-address-card mx-1 p-1 transition-all duration-200 transform hover:scale-125"></i>
          </button>
          
        </td>
      </tr>
      `;
  });
}

function openViewUserModal(idUser) {
  getUserById(idUser);
  document.querySelector(".modalViewUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
}

function closeViewUserModal() {
  document.querySelector(".modalViewUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function getUserById(idUser) {
  let user = {
    idUser: idUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "admin/users/id", params)
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      displayUserById(JSON.parse(data));
    });
}

function displayUserById(User) {
  document.querySelector(".divViewUser").innerHTML =
    `
    <h3 class="text-2xl text-center mb-8 font-bold">` +
    User.firstname_user +
    ` ` +
    User.lastname_user +
    `</h3>
    <div class='flex justify-between my-2'>
      <p class='italic'>` +
    User.login_user +
    `</p>
      <p><i class="fa-solid fa-graduation-cap"></i> ` +
    isNull(User.name_level) +
    `</p>
    </div>
    <p> <span class='font-bold'>Email : </span>` +
    User.email_user +
    `</p>
    <p> <span class='font-bold'>Téléphone : </span>` +
    isNull(User.phone_user) +
    `</p>
    <p> <span class='font-bold'>Adresse : </span>` +
    isNull(User.address_user) +
    `</p>
    <p> <span class='font-bold'>Date de naissance : </span>` +
    isNull(User.birthdate_user) +
    `</p>
    <p> <span class='font-bold'>Role : </span>` +
    User.role_user +
    `</p>
    <p> <span class='font-bold'>Compte actif : </span>` +
    isActif(User.actif_user) +
    `</p>
    <p> <span class='font-bold'>Acceptation des RGPD : </span>` +
    User.gdpr_user +
    `</p>

    <div class="flex justify-around mt-8">
      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openEditUserModal(` +
    User +
    `)">Modifier</button>

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openDeleteUserModal(` +
    User.id_user +
    `, '` +
    User.firstname_user +
    `')">Supprimer</button>
    </div>
  `;
}

function isActif(dataActif) {
  if (dataActif == 1) {
    return "Oui";
  } else {
    return "Non";
  }
}

// Edit User
function openEditUserModal(User) {
  console.log(User);
}
