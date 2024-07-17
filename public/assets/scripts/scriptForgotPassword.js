// Emailing change password

function emailingForgetPassword() {
  let emailForgetPassword = document.querySelector(
    "#emailForgetPassword"
  ).value;
  let errorMessageEmailingForgetPassword = document.querySelector(
    "#errorMessageEmailingForgetPassword"
  );
  errorMessageEmailingForgetPassword.innerHTML = "";

  if (emailForgetPassword !== "") {
    if (checkEmail(emailForgetPassword)) {
      sendEmailForgetPassword(emailForgetPassword);
    } else {
      errorMessageEmailingForgetPassword.innerHTML =
        "Merci de rentrer un email valide";
    }
  } else {
    errorMessageEmailingForgetPassword.innerHTML =
      "Merci de rentrer votre email";
  }
}

function sendEmailForgetPassword(emailForgetPassword) {
  let user = {
    emailForgetPassword: emailForgetPassword,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "emailingForgetPassword/email", params)
    .then((res) => res.text())
    .then((data) => {
      let response = JSON.parse(data);
      if (response.status == "success") {
        openSuccessMessage(response.message);
        console.log("dans le if");
      } else {
        document.getElementById(
          "errorMessageEmailingForgetPassword"
        ).innerHTML = response.message;
      }
    });
}

// Change password

function forgotPasswordVerification(idForgotPassword) {
  let loginUser = document.querySelector("#loginForgotPassword").value;
  let errorMessageforgotPassword = document.querySelector(
    "#errorMessageforgotPassword"
  );
  errorMessageforgotPassword.innerHTML = "";

  if (loginUser !== "") {
    if (isValidLogin(loginUser)) {
      verificationLoginForgotPassword(idForgotPassword, loginUser);
    } else {
      errorMessageforgotPassword.innerHTML =
        "Merci de rentrer un identifiant valide";
    }
  } else {
    errorMessageforgotPassword.innerHTML = "Merci de rentrer votre identifiant";
  }
}

function verificationLoginForgotPassword(idForgotPassword, loginUser) {
  let user = {
    idForgotPassword: idForgotPassword,
    loginUser: loginUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "forgotPassword/userLogin", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).status == "success") {
        getForgotPasswordUserById(idForgotPassword, loginUser);
      } else {
        document.querySelector("#errorMessageRegister").innerHTML =
          "Identifiant incorrect";
      }
    });
}

function getForgotPasswordUserById(idForgotPasswordUser, loginUser) {
  let user = {
    idForgotPasswordUser: idForgotPasswordUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(user),
  };

  fetch(HOME_URL + "forgotPassword/user", params)
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
  <h3 class="font-bold" style='font-family: "Amatic SC", sans-serif;'>Réinitialiser votre mot de passe</h3>
  
  <div class='divform'>
      <label for="passwordForgotPasswordUser" class='labelRegister'>Mot de passe *</label>
      <input type="password" name="passwordForgotPasswordUser" id="passwordForgotPasswordUser" class="inputRegister" placeholder='******'>
  </div>

  <div class='divform'>
      <label for="passwordbisForgotPasswordUser" class='labelRegister'>Confirmation du mot de passe *</label>
      <input type="password" name="passwordbisForgotPasswordUser" id="passwordbisForgotPasswordUser" class="inputRegister" placeholder='******'>
  </div>

  
  <div id="errorMessageUserRegister"></div>
  <div class="divbutton">
      <button type="button" class="btnRegister" onclick='changePasswordUserVerification(` +
    User.id_user +
    `, "` +
    loginUser +
    `")'>Inscription</button>
  </div>
  `;
}

function changePasswordUserVerification(idUser, loginUser) {
  let passwordForgotPasswordUser = document.getElementById(
    "passwordForgotPasswordUser"
  ).value;
  let passwordbisForgotPasswordUser = document.getElementById(
    "passwordbisForgotPasswordUser"
  ).value;

  let errorMessageUserRegister = document.getElementById(
    "errorMessageUserRegister"
  );

  errorMessageUserRegister.innerHTML = "";

  if (
    passwordForgotPasswordUser !== "" &&
    passwordbisForgotPasswordUser !== ""
  ) {
    if (passwordForgotPasswordUser == passwordbisForgotPasswordUser) {
      if (passwordForgotPasswordUser.length >= 6) {
        changePasswordUser(
          idUser,
          loginUser,
          passwordForgotPasswordUser,
          passwordbisForgotPasswordUser
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
      "Merci de remplir tous les champs avec une *.";
  }
}

function changePasswordUser(
  idUser,
  loginUser,
  passwordForgotPasswordUser,
  passwordbisForgotPasswordUser
) {
  let User = {
    idUser: idUser,
    loginUser: loginUser,
    passwordForgotPasswordUser: passwordForgotPasswordUser,
    passwordbisForgotPasswordUser: passwordbisForgotPasswordUser,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(User),
  };

  fetch(HOME_URL + "forgotPassword/change", params)
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
