function getAllUserSelect(idUserGiven = 0, div = "select", action = "add") {
  let choice = {
    name: "firstname_user",
    order: "ASC",
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(choice),
  };

  fetch(HOME_URL + "admin/users/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        if (div == "select") {
          displayUserSelect(JSON.parse(data), idUserGiven);
        } else if (div == "checkbox") {
          displayUserSelectCheckbox(JSON.parse(data), idUserGiven, action);
        }
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
        ` class='mb-3 block text-base font-medium  ' 
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
        <input type="checkbox" class="userLessonAdd" value=` +
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
function getAllUsers(name, order) {
  let choice = {
    name: name,
    order: order,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(choice),
  };

  fetch(HOME_URL + "admin/users/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayUser(JSON.parse(data));
      }
    });
}

function displayUser(usersData) {
  document.querySelector(".tbodyUser").innerHTML = "";

  usersData.forEach((userData) => {
    document.querySelector(".tbodyUser").innerHTML +=
      `
      <tr class='border-b hover:bg-neutral-100
        ${userData.actif_user == 0 ? "text-gray-500" : ""}'>
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
      isNull(userData.phone_user) +
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

let order = "ASC";
function chooseOrder($name) {
  if (order == "DESC") {
    getAllUsers($name, "DESC");
    order = "ASC";
  } else {
    getAllUsers($name, "ASC");
    order = "DESC";
  }
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

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "admin/users/id", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        displayUserById(JSON.parse(data));
      }
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
    isNull(User.gdpr_user) +
    `</p>

    <div class="flex justify-around mt-8">
      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick='openEditUserModal(` +
    JSON.stringify(User) +
    `)'>Modifier</button>

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openDeleteDisableUserModal(` +
    User.id_user +
    `, '` +
    User.firstname_user +
    `', '` +
    User.lastname_user +
    `')">Supprimer / Désactiver</button>
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

//Add box
function openAddUserModal() {
  getAllLevel();
  document.querySelector(".modalAddUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
}

function closeAddUserModal() {
  document.querySelector(".modalAddUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function AddUserVerification() {
  let lastnameUserAdd = document.getElementById("lastnameUserAdd").value;
  let firstnameUserAdd = document.getElementById("firstnameUserAdd").value;
  let emailUserAdd = document.getElementById("emailUserAdd").value;
  let phoneUserAdd = document.getElementById("phoneUserAdd").value;
  let birthdateUserAdd = document.getElementById("birthdateUserAdd").value;
  let addressUserAdd = document.getElementById("addressUserAdd").value;
  let roleUserAdd = document.getElementById("roleUserAdd").value;
  let levelUserAdd = document.getElementById("levelUserAdd").value;
  let errorMessageUserAdd = document.getElementById("errorMessageUserAdd");

  errorMessageUserAdd.innerHTML = "";

  if (
    lastnameUserAdd !== "" &&
    firstnameUserAdd !== "" &&
    emailUserAdd !== "" &&
    roleUserAdd !== ""
  ) {
    if (lastnameUserAdd.length <= 50 && firstnameUserAdd.length <= 50) {
      if (checkEmail(emailUserAdd)) {
        if (isValidPhone(phoneUserAdd) || phoneUserAdd == "") {
          if (phoneUserAdd == "") {
            phoneUserAdd == null;
          }
          if (isValidDateFormat(birthdateUserAdd) || birthdateUserAdd == "") {
            if (birthdateUserAdd == "") {
              birthdateUserAdd == null;
            }
            if (addressUserAdd.length <= 255) {
              if (addressUserAdd == "") {
                addressUserAdd == null;
              }
              if (roleUserAdd == "User" || roleUserAdd == "Admin") {
                if (Number(levelUserAdd) || levelUserAdd == "") {
                  if (levelUserAdd == "") {
                    levelUserAdd == null;
                  } else {
                    parseInt(levelUserAdd);
                  }

                  AddUser(
                    lastnameUserAdd,
                    firstnameUserAdd,
                    emailUserAdd,
                    phoneUserAdd,
                    birthdateUserAdd,
                    addressUserAdd,
                    roleUserAdd,
                    levelUserAdd
                  );
                } else {
                  errorMessageUserAdd.innerHTML =
                    "Merci de selectionner un niveau dans la liste.";
                }
              } else {
                errorMessageUserAdd.innerHTML =
                  "Merci de selectionner un role.";
              }
            } else {
              errorMessageUserAdd.innerHTML =
                "L'adresse doit faire au maximum 255 caractères.";
            }
          } else {
            errorMessageUserAdd.innerHTML = "Merci de rentrer une date valide.";
          }
        } else {
          errorMessageUserAdd.innerHTML =
            "Merci de rentrer un numéro de téléphone valide (ex: 0123456789).";
        }
      } else {
        errorMessageUserAdd.innerHTML = "Merci de rentrer un email valide.";
      }
    } else {
      errorMessageUserAdd.innerHTML =
        "Le nom et le prénom doivent faire au maximum 50 caractères.";
    }
  } else {
    errorMessageUserAdd.innerHTML =
      "Merci de remplir tous les champs avec une *.";
  }
}

function AddUser(
  lastnameUserAdd,
  firstnameUserAdd,
  emailUserAdd,
  phoneUserAdd,
  birthdateUserAdd,
  addressUserAdd,
  roleUserAdd,
  levelUserAdd
) {
  let newUser = {
    lastnameUserAdd: lastnameUserAdd,
    firstnameUserAdd: firstnameUserAdd,
    emailUserAdd: emailUserAdd,
    phoneUserAdd: phoneUserAdd,
    birthdateUserAdd: birthdateUserAdd,
    addressUserAdd: addressUserAdd,
    roleUserAdd: roleUserAdd,
    levelUserAdd: levelUserAdd,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newUser),
  };

  fetch(HOME_URL + "admin/users/add", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseAddUser(JSON.parse(data));
      }
    });
}

function reponseAddUser(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllUsers();
    closeAddUserModal();
  } else {
    document.getElementById("errorMessageUserAdd").innerHTML = data.message;
  }
}

// Edit User
function openEditUserModal(User) {
  console.log(User);
  getAllLevel(User.id_level);
  let divEditUser = document.querySelector(".divEditUser");

  document.querySelector(".modalEditUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
  document.querySelector(".modalViewUser").classList.add("hidden");

  divEditUser.innerHTML =
    `
  <h3 class="text-2xl text-center mb-8">Modifier ` +
    User.firstname_user +
    ` ` +
    User.lastname_user +
    `</h3>

  <div class="-mx-3 flex flex-wrap">
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="lastnameUserEdit" class='mb-3 block text-base font-medium  "'>Nom*</label>
              <input type="text" name="lastnameUserEdit" id="lastnameUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    User.lastname_user +
    `'>

              </select>
          </div>
      </div>
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="firstnameUserEdit" class='mb-3 block text-base font-medium  "'>Prénom*</label>
              <input type="text" name="firstnameUserEdit" id="firstnameUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    User.firstname_user +
    `'>
          </div>
      </div>
  </div>

  <div class="mb-5">
      <label for="emailUserEdit" class='mb-3 block text-base font-medium  "'>Email*</label>
      <input type="text" name="emailUserEdit" id="emailUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    User.email_user +
    `'>
  </div>

  <div class="-mx-3 flex flex-wrap">
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="phoneUserEdit" class='mb-3 block text-base font-medium  "'>Téléphone</label>
              <input type="tel" name="phoneUserEdit" id="phoneUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    isNull(User.phone_user) +
    `>
          </div>
      </div>
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="birthdateUserEdit" class='mb-3 block text-base font-medium  "'>Date de naissance</label>
              <input type="date" name="birthdateUserEdit" id="birthdateUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    User.birthdate_user +
    `>
          </div>
      </div>
  </div>

  <div class="mb-5">
      <label for="addressUserEdit" class='mb-3 block text-base font-medium  "'>Adresse</label>
      <input type="text" name="addressUserEdit" id="addressUserEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    isNull(User.address_user) +
    `'>
  </div>

  <div class="-mx-3 flex flex-wrap">
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="roleUserEdit" class='mb-3 block text-base font-medium  "'>Role*</label>
              <select name="roleUserEdit" id="roleUserEdit" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">
                <option value="User" ` +
    isSelected(User.role_user, "User") +
    `>User</option>
                <option value="Admin" ` +
    isSelected(User.role_user, "Admin") +
    `>Admin</option>
              </select>

          </div>
      </div>
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="levelUserEdit" class='mb-3 block text-base font-medium  "'>Niveau</label>

              <select name="levelUserEdit" id="levelUserEdit" class="levelUser w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md">

              </select>
          </div>
      </div>
  </div>

  <div id="errorMessageUserEdit"></div>

  <div class="w-fit m-auto mt-8">

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick='EditUserVerification(` +
    User.id_user +
    `)'>Modifier</button>
  </div>
  `;
}

function closeEditUserModal() {
  document.querySelector(".modalEditUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function EditUserVerification(idUser) {
  let lastnameUserEdit = document.getElementById("lastnameUserEdit").value;
  let firstnameUserEdit = document.getElementById("firstnameUserEdit").value;
  let emailUserEdit = document.getElementById("emailUserEdit").value;
  let phoneUserEdit = document.getElementById("phoneUserEdit").value;
  let birthdateUserEdit = document.getElementById("birthdateUserEdit").value;
  let addressUserEdit = document.getElementById("addressUserEdit").value;
  let roleUserEdit = document.getElementById("roleUserEdit").value;
  let levelUserEdit = document.getElementById("levelUserEdit").value;
  let errorMessageUserEdit = document.getElementById("errorMessageUserEdit");

  errorMessageUserEdit.innerHTML = "";

  if (
    lastnameUserEdit !== "" &&
    firstnameUserEdit !== "" &&
    emailUserEdit !== "" &&
    roleUserEdit !== ""
  ) {
    if (lastnameUserEdit.length <= 50 && firstnameUserEdit.length <= 50) {
      if (checkEmail(emailUserEdit)) {
        if (isValidPhone(phoneUserEdit) || phoneUserEdit == "") {
          if (phoneUserEdit == "") {
            phoneUserEdit == null;
          }
          if (isValidDateFormat(birthdateUserEdit) || birthdateUserEdit == "") {
            if (birthdateUserEdit == "") {
              birthdateUserEdit == null;
            }
            if (addressUserEdit.length <= 255) {
              if (addressUserEdit == "") {
                addressUserEdit == null;
              }
              if (roleUserEdit == "User" || roleUserEdit == "Admin") {
                if (Number(levelUserEdit) || levelUserEdit == "") {
                  if (levelUserEdit == "") {
                    levelUserEdit == null;
                  } else {
                    parseInt(levelUserEdit);
                  }

                  EditUser(
                    idUser,
                    lastnameUserEdit,
                    firstnameUserEdit,
                    emailUserEdit,
                    phoneUserEdit,
                    birthdateUserEdit,
                    addressUserEdit,
                    roleUserEdit,
                    levelUserEdit
                  );
                } else {
                  errorMessageUserEdit.innerHTML =
                    "Merci de selectionner un niveau dans la liste.";
                }
              } else {
                errorMessageUserEdit.innerHTML =
                  "Merci de selectionner un role.";
              }
            } else {
              errorMessageUserEdit.innerHTML =
                "L'adresse doit faire au maximum 255 caractères.";
            }
          } else {
            errorMessageUserEdit.innerHTML =
              "Merci de rentrer une date valide.";
          }
        } else {
          errorMessageUserEdit.innerHTML =
            "Merci de rentrer un numéro de téléphone valide (ex: 0123456789).";
        }
      } else {
        errorMessageUserEdit.innerHTML = "Merci de rentrer un email valide.";
      }
    } else {
      errorMessageUserEdit.innerHTML =
        "Le nom et le prénom doivent faire au maximum 50 caractères.";
    }
  } else {
    errorMessageUserEdit.innerHTML =
      "Merci de remplir tous les champs avec une *.";
  }
}

function EditUser(
  idUserEdit,
  lastnameUserEdit,
  firstnameUserEdit,
  emailUserEdit,
  phoneUserEdit,
  birthdateUserEdit,
  addressUserEdit,
  roleUserEdit,
  levelUserEdit
) {
  let editUser = {
    idUserEdit: idUserEdit,
    lastnameUserEdit: lastnameUserEdit,
    firstnameUserEdit: firstnameUserEdit,
    emailUserEdit: emailUserEdit,
    phoneUserEdit: phoneUserEdit,
    birthdateUserEdit: birthdateUserEdit,
    addressUserEdit: addressUserEdit,
    roleUserEdit: roleUserEdit,
    levelUserEdit: levelUserEdit,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editUser),
  };

  fetch(HOME_URL + "admin/users/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditUser(JSON.parse(data));
      }
    });
}

function reponseEditUser(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllUsers();
    closeEditUserModal();
  } else {
    document.getElementById("errorMessageUserEdit").innerHTML = data.message;
  }
}

// Delete Disable User
function openDeleteDisableUserModal(idUser, firstnameUser, lastnameUser) {
  document.querySelector(".modalViewUser").classList.add("hidden");
  document.querySelector(".modalDeleteDisableUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  document.querySelector(".deleteDisableUserMessage").innerHTML =
    `
    <p class='mx-10'> Voulez-vous supprimer ou désactiver le compte de ` +
    firstnameUser +
    ` ` +
    lastnameUser +
    ` ? </p>
    <div class='flex justify-around mt-8'>
      <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick="openDisableUserModal(` +
    idUser +
    `, '` +
    firstnameUser +
    `', '` +
    lastnameUser +
    `')" >Désactiver</button>
      <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick="openDeleteUserModal(` +
    idUser +
    `, '` +
    firstnameUser +
    `', '` +
    lastnameUser +
    `')" >Supprimer</button>
  </div>
  `;
}

function closeDeleteDisableUserModal() {
  document.querySelector(".modalDeleteDisableUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

// Disable User
function openDisableUserModal(idUser, firstnameUser, lastnameUser) {
  document.querySelector(".modalDeleteDisableUser").classList.add("hidden");
  document.querySelector(".modalDeleteUser").classList.remove("hidden");
  document.querySelector(".deleteUserMessage").innerHTML =
    `<p class='mx-10'>Voulez-vous désactiver le compte de ` +
    firstnameUser +
    ` ` +
    lastnameUser +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick=disableUser(` +
    idUser +
    `) >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDisableUserModal() >Non</button>
  </div>
  `;
}

function closeDisableUserModal() {
  document.querySelector(".modalDeleteUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function disableUser(idUser) {
  let user = {
    idUser: idUser,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "admin/users/disable", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseDeleteUser(JSON.parse(data));
      }
    });
}

function reponseDeleteUser(data) {
  openSuccessMessage(data.message);
  getAllUsers();
  closeDisableUserModal();
}

// Delete User

function openDeleteUserModal(idUser, firstnameUser, lastnameUser) {
  document.querySelector(".modalDeleteDisableUser").classList.add("hidden");
  document.querySelector(".modalDeleteUser").classList.remove("hidden");
  document.querySelector(".deleteUserMessage").innerHTML =
    `<p class='mx-10'>Voulez-vous vraiment suppimer le compte de ` +
    firstnameUser +
    ` ` +
    lastnameUser +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#895B1E] text-white border-2 border-[#895B1E] hover:bg-white hover:text-[#895B1E] rounded-xl font-bold" onclick=deleteUser(` +
    idUser +
    `) >Oui</button>
    <button class="p-2 bg-white text-[#895B1E] border-2 border-[#895B1E] hover:bg-[#895B1E] hover:text-white rounded-xl font-bold" onclick=closeDeleteUserModal() >Non</button>
  </div>
  `;
}

function closeDeleteUserModal() {
  document.querySelector(".modalDeleteUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function deleteUser(idUser) {
  let user = {
    idUser: idUser,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "admin/users/delete", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseDeleteUser(JSON.parse(data));
      }
    });
}

function reponseDeleteUser(data) {
  openSuccessMessage(data.message);
  getAllUsers();
  closeDeleteUserModal();
}
