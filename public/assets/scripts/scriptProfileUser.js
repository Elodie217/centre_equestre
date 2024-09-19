function getUser(role) {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  if (role == "user") {
    fetch(HOME_URL + "user/profile/userbyid", params)
      .then((res) => res.text())
      .then((data) => {
        if (JSON.parse(data).message == "JWT incorrect") {
          logout();
        } else {
          displayProfileUser(JSON.parse(data), role);
        }
      });
  } else if (role == "admin") {
    fetch(HOME_URL + "admin/profile/userbyid", params)
      .then((res) => res.text())
      .then((data) => {
        if (JSON.parse(data).message == "JWT incorrect") {
          logout();
        } else {
          displayProfileUser(JSON.parse(data), role);
        }
      });
  }
}

function displayProfileUser(user, role) {
  document.querySelector(".divProfileUser").innerHTML =
    `
    <div class="flex justify-between items-center my-6 mx-32">
        <h1 class="text-6xl font-bold" style='font-family: "Amatic SC", sans-serif;'>Mon compte</h1>

        <p class="mr-40 text-xl">
            <span class='mr-2 font-bold'>Identifiant : </span>` +
    user.login_user +
    `
        </p>
    </div>

    <div class='text-xl my-10 mx-44'>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Nom : </span>` +
    user.lastname_user +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Prénom : </span>` +
    user.firstname_user +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Date de naissance : </span>` +
    user.birthdate_user +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Email : </span>` +
    user.email_user +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Téléphone : </span>` +
    isNull(user.phone_user) +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Adresse : </span>` +
    isNull(user.address_user) +
    `
        </p>
        <p class='my-6'>
            <span class='mr-2 font-bold'>Niveau : </span>` +
    isNull(user.name_level) +
    `
        </p>
    </div>
    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit mx-32 mt-12 mb-20 text-xl" onclick='openEditProfileUser(` +
    JSON.stringify(user) +
    `, "` +
    role +
    `")'>Modifier</button>
  `;
}

// Edit User
function openEditProfileUser(User, role) {
  console.log(User);
  let divEditProfileUser = document.querySelector(".divEditProfileUser");

  document.querySelector(".modalEditProfileUser").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  divEditProfileUser.innerHTML =
    `
  <h3 class="text-2xl text-center mb-8">Modifier mon compte</h3>

  <div class="-mx-3 flex flex-wrap">
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="lastnameUserProfileEdit" class='mb-3 block text-base font-medium  "'>Nom*</label>
              <input type="text" name="lastnameUserProfileEdit" id="lastnameUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    User.lastname_user +
    `'>

              </select>
          </div>
      </div>
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="firstnameUserProfileEdit" class='mb-3 block text-base font-medium  "'>Prénom*</label>
              <input type="text" name="firstnameUserProfileEdit" id="firstnameUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    User.firstname_user +
    `'>
          </div>
      </div>
  </div>

  <div class="mb-5">
      <label for="emailUserProfileEdit" class='mb-3 block text-base font-medium  "'>Email*</label>
      <input type="text" name="emailUserProfileEdit" id="emailUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    User.email_user +
    `'>
  </div>

  <div class="-mx-3 flex flex-wrap">
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="phoneUserProfileEdit" class='mb-3 block text-base font-medium  "'>Téléphone</label>
              <input type="tel" name="phoneUserProfileEdit" id="phoneUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    isNull(User.phone_user) +
    `>
          </div>
      </div>
      <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
              <label for="birthdateUserProfileEdit" class='mb-3 block text-base font-medium  "'>Date de naissance</label>
              <input type="date" name="birthdateUserProfileEdit" id="birthdateUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value=` +
    User.birthdate_user +
    `>
          </div>
      </div>
  </div>

  <div class="mb-5">
      <label for="addressUserProfileEdit" class='mb-3 block text-base font-medium  "'>Adresse</label>
      <input type="text" name="addressUserProfileEdit" id="addressUserProfileEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#C0DF85] focus:shadow-md" value='` +
    isNull(User.address_user) +
    `'>
  </div>


  <div id="errorMessageUserProfileEdit"></div>

  <div class="w-fit m-auto mt-8">

      <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#A16C21] bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick='EditProfileUserVerification(` +
    User.id_user +
    `, "` +
    role +
    `")'>Modifier</button>
  </div>
  `;
}

function closeEditProfileUserModal() {
  document.querySelector(".modalEditProfileUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function EditProfileUserVerification(idUser, role) {
  let lastnameUserProfileEdit = document.getElementById(
    "lastnameUserProfileEdit"
  ).value;
  let firstnameUserProfileEdit = document.getElementById(
    "firstnameUserProfileEdit"
  ).value;
  let emailUserProfileEdit = document.getElementById(
    "emailUserProfileEdit"
  ).value;
  let phoneUserProfileEdit = document.getElementById(
    "phoneUserProfileEdit"
  ).value;
  let birthdateUserProfileEdit = document.getElementById(
    "birthdateUserProfileEdit"
  ).value;
  let addressUserProfileEdit = document.getElementById(
    "addressUserProfileEdit"
  ).value;
  let errorMessageUserProfileEdit = document.getElementById(
    "errorMessageUserProfileEdit"
  );

  errorMessageUserProfileEdit.innerHTML = "";

  if (
    lastnameUserProfileEdit !== "" &&
    firstnameUserProfileEdit !== "" &&
    emailUserProfileEdit !== ""
  ) {
    if (
      lastnameUserProfileEdit.length <= 50 &&
      firstnameUserProfileEdit.length <= 50
    ) {
      if (checkEmail(emailUserProfileEdit)) {
        if (isValidPhone(phoneUserProfileEdit) || phoneUserProfileEdit == "") {
          if (phoneUserProfileEdit == "") {
            phoneUserProfileEdit == null;
          }
          if (
            isValidDateFormat(birthdateUserProfileEdit) ||
            birthdateUserProfileEdit == ""
          ) {
            if (birthdateUserProfileEdit == "") {
              birthdateUserProfileEdit == null;
            }
            if (addressUserProfileEdit.length <= 255) {
              if (addressUserProfileEdit == "") {
                addressUserProfileEdit == null;
              }

              EditProfileUser(
                idUser,
                lastnameUserProfileEdit,
                firstnameUserProfileEdit,
                emailUserProfileEdit,
                phoneUserProfileEdit,
                birthdateUserProfileEdit,
                addressUserProfileEdit,
                role
              );
            } else {
              errorMessageUserProfileEdit.innerHTML =
                "L'adresse doit faire au maximum 255 caractères.";
            }
          } else {
            errorMessageUserProfileEdit.innerHTML =
              "Merci de rentrer une date valide.";
          }
        } else {
          errorMessageUserProfileEdit.innerHTML =
            "Merci de rentrer un numéro de téléphone valide (ex: 0123456789).";
        }
      } else {
        errorMessageUserProfileEdit.innerHTML =
          "Merci de rentrer un email valide.";
      }
    } else {
      errorMessageUserProfileEdit.innerHTML =
        "Le nom et le prénom doivent faire au maximum 50 caractères.";
    }
  } else {
    errorMessageUserProfileEdit.innerHTML =
      "Merci de remplir tous les champs avec une *.";
  }
}

function EditProfileUser(
  idUserProfileEdit,
  lastnameUserProfileEdit,
  firstnameUserProfileEdit,
  emailUserProfileEdit,
  phoneUserProfileEdit,
  birthdateUserProfileEdit,
  addressUserProfileEdit,
  role
) {
  let editUser = {
    idUserProfileEdit: idUserProfileEdit,
    lastnameUserProfileEdit: lastnameUserProfileEdit,
    firstnameUserProfileEdit: firstnameUserProfileEdit,
    emailUserProfileEdit: emailUserProfileEdit,
    phoneUserProfileEdit: phoneUserProfileEdit,
    birthdateUserProfileEdit: birthdateUserProfileEdit,
    addressUserProfileEdit: addressUserProfileEdit,
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

  if (role == "user") {
    fetch(HOME_URL + "user/profile/edit", params)
      .then((res) => res.text())
      .then((data) => {
        if (JSON.parse(data).message == "JWT incorrect") {
          logout();
        } else {
          reponseEditProfileUser(JSON.parse(data), role);
        }
      });
  } else if (role == "admin") {
    fetch(HOME_URL + "admin/profile/edit", params)
      .then((res) => res.text())
      .then((data) => {
        if (JSON.parse(data).message == "JWT incorrect") {
          logout();
        } else {
          reponseEditProfileUser(JSON.parse(data), role);
        }
      });
  }
}

function reponseEditProfileUser(data, role) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getUser(role);
    closeEditProfileUserModal();
  } else {
    document.getElementById("errorMessageUserProfileEdit").innerHTML =
      data.message;
  }
}
