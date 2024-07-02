function registerVerification(idNewUser) {
  let loginUser = document.querySelector("#loginRegister").value;
  let errorMessageRegister = document.querySelector("#errorMessageRegister");
  errorMessageRegister.innerHTML = "";

  if (loginUser !== "") {
    if (isValidLogin(loginUser)) {
      verificationLoginUser(idNewUser, loginUser);
    } else {
      errorMessageRegister.innerHTML = "Merci de rentrer un identifiant valide";
    }
  } else {
    errorMessageRegister.innerHTML = "Merci de rentrer votre identifiant";
  }
}

function verificationLoginUser(idNewUser, loginUser) {
  let user = {
    idNewUser: idNewUser,
    loginUser: loginUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "register/userLogin", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).status == "success") {
        getNewUserById(idNewUser, loginUser);
      } else {
        document.querySelector("#errorMessageRegister").innerHTML =
          "Identifiant incorrect";
      }
    });
}

function getNewUserById(idNewUser, loginUser) {
  let user = {
    idNewUser: idNewUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "register/user", params)
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      displayUserRegister(JSON.parse(data), loginUser);
    });
}

function displayUserRegister(User, loginUser) {
  let divRegister = document.querySelector(".divRegister");

  divRegister.innerHTML =
    `
  <h3>Inscription</h3>
  <div class="divFormRegister">
      <div class="divformhalf">
          <div>
              <label for="lastnameUserRegister" class='labelRegister'>Nom*</label>
              <input type="text" name="lastnameUserRegister" id="lastnameUserRegister" class="inputRegister" value='` +
    User.lastname_user +
    `'>
          </div>
      </div>
      <div class="divformhalf">
          <div>
              <label for="firstnameUserRegister" class='labelRegister'>Prénom*</label>
              <input type="text" name="firstnameUserRegister" id="firstnameUserRegister" class="inputRegister" value='` +
    User.firstname_user +
    `'>
          </div>
      </div>
  </div>
  <div class='divform'>
      <label for="emailUserRegister" class='labelRegister'>Email*</label>
      <input type="text" name="emailUserRegister" id="emailUserRegister" class="inputRegister" value='` +
    User.email_user +
    `'>
  </div>
  <div class="divFormRegister">
      <div class="divformhalf">
          <div>
              <label for="phoneUserRegister" class='labelRegister'>Téléphone</label>
              <input type="tel" name="phoneUserRegister" id="phoneUserRegister" class="inputRegister" value=` +
    isNull(User.phone_user) +
    `>
          </div>
      </div>
      <div class="divformhalf">
          <div>
              <label for="birthdateUserRegister" class='labelRegister'>Date de naissance*</label>
              <input type="date" name="birthdateUserRegister" id="birthdateUserRegister" class="inputRegister" value=` +
    User.birthdate_user +
    `>
          </div>
      </div>
  </div>
  <div class='divform'>
      <label for="addressUserRegister" class='labelRegister'>Adresse</label>
      <input type="text" name="addressUserRegister" id="addressUserRegister" class="inputRegister" value='` +
    isNull(User.address_user) +
    `'>
  </div>

  <div class="divFormRegister items-end">
      <div class="divformhalf">
          <div>
              <label for="passwordRegister" class='labelRegister'>Mot de passe* <br/> <span class='passwordSpan'> Le mot de passe doit contenir au minimum 6 caractères.</span></label>
              <input type="password" name="passwordRegister" id="passwordRegister" class="inputRegister">
          </div>
      </div>
      <div class="divformhalf">
          <div>
              <label for="passwordRegisterBis" class='labelRegister'>Confirmation du mot de passe*</label>
              <input type="password" name="passwordRegisterBis" id="passwordRegisterBis" class="inputRegister">
          </div>
      </div>
  </div>
  
  <div id="errorMessageUserRegister"></div>
  <div class="divbutton">
      <button type="button" class="btnRegister" onclick='registerUserVerification(` +
    User.id_user +
    `, "` +
    loginUser +
    `")'>Inscription</button>
  </div>
  `;
}

function registerUserVerification(idUser, loginUser) {
  let lastnameUserRegister = document.getElementById(
    "lastnameUserRegister"
  ).value;
  let firstnameUserRegister = document.getElementById(
    "firstnameUserRegister"
  ).value;
  let emailUserRegister = document.getElementById("emailUserRegister").value;
  let phoneUserRegister = document.getElementById("phoneUserRegister").value;
  let birthdateUserRegister = document.getElementById(
    "birthdateUserRegister"
  ).value;
  let addressUserRegister = document.getElementById(
    "addressUserRegister"
  ).value;
  let passwordRegister = document.getElementById("passwordRegister").value;
  let passwordRegisterBis = document.getElementById(
    "passwordRegisterBis"
  ).value;

  let errorMessageUserRegister = document.getElementById(
    "errorMessageUserRegister"
  );

  errorMessageUserRegister.innerHTML = "";

  if (
    lastnameUserRegister !== "" &&
    firstnameUserRegister !== "" &&
    emailUserRegister !== "" &&
    birthdateUserRegister !== "" &&
    passwordRegister !== "" &&
    passwordRegisterBis !== ""
  ) {
    if (
      lastnameUserRegister.length <= 50 &&
      firstnameUserRegister.length <= 50
    ) {
      if (checkEmail(emailUserRegister)) {
        if (isValidPhone(phoneUserRegister) || phoneUserRegister == "") {
          if (phoneUserRegister == "") {
            phoneUserRegister == null;
          }
          if (
            isValidDateFormat(birthdateUserRegister) ||
            birthdateUserRegister == ""
          ) {
            if (birthdateUserRegister == "") {
              birthdateUserRegister == null;
            }
            if (addressUserRegister.length <= 255) {
              if (addressUserRegister == "") {
                addressUserRegister == null;
              }
              if (passwordRegister == passwordRegisterBis) {
                if (passwordRegister.length >= 6) {
                  RegisterUser(
                    idUser,
                    loginUser,
                    lastnameUserRegister,
                    firstnameUserRegister,
                    emailUserRegister,
                    phoneUserRegister,
                    birthdateUserRegister,
                    addressUserRegister,
                    passwordRegister,
                    passwordRegisterBis
                  );
                } else {
                  errorMessageUserRegister.innerHTML =
                    "Le mot de passe doit faire au minimum 6 caractères.";
                }
              } else {
                errorMessageUserRegister.innerHTML =
                  "Les mots de passe doivent être identiques.";
              }
            } else {
              errorMessageUserRegister.innerHTML =
                "L'adresse doit faire au maximum 255 caractères.";
            }
          } else {
            errorMessageUserRegister.innerHTML =
              "Merci de rentrer une date valide.";
          }
        } else {
          errorMessageUserRegister.innerHTML =
            "Merci de rentrer un numéro de téléphone valide (ex: 0123456789).";
        }
      } else {
        errorMessageUserRegister.innerHTML =
          "Merci de rentrer un email valide.";
      }
    } else {
      errorMessageUserRegister.innerHTML =
        "Le nom et le prénom doivent faire au maximum 50 caractères.";
    }
  } else {
    errorMessageUserRegister.innerHTML =
      "Merci de remplir tous les champs avec une *.";
  }
}

function RegisterUser(
  idUser,
  loginUser,
  lastnameUserRegister,
  firstnameUserRegister,
  emailUserRegister,
  phoneUserRegister,
  birthdateUserRegister,
  addressUserRegister,
  passwordRegister,
  passwordRegisterBis
) {
  let User = {
    idUser: idUser,
    loginUser: loginUser,
    lastnameUserRegister: lastnameUserRegister,
    firstnameUserRegister: firstnameUserRegister,
    emailUserRegister: emailUserRegister,
    phoneUserRegister: phoneUserRegister,
    birthdateUserRegister: birthdateUserRegister,
    addressUserRegister: addressUserRegister,
    passwordRegister: passwordRegister,
    passwordRegisterBis: passwordRegisterBis,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(User),
  };

  fetch(HOME_URL + "register/registration", params)
    .then((res) => res.text())
    .then((data) => reponseRegisterUser(JSON.parse(data)));
}

function reponseRegisterUser(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    setTimeout(() => {
      redirect("login");
    }, 2000);
  } else {
    document.getElementById("errorMessageUserRegister").innerHTML =
      data.message;
  }
}
