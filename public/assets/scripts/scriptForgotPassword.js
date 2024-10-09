// Emailing change password

function emailingForgetPassword() {
  let loginForgetPassword = document.querySelector(
    "#loginForgetPassword"
  ).value;
  let emailForgetPassword = document.querySelector(
    "#emailForgetPassword"
  ).value;
  let errorMessageEmailingForgetPassword = document.querySelector(
    "#errorMessageEmailingForgetPassword"
  );
  errorMessageEmailingForgetPassword.innerHTML = "";

  if (loginForgetPassword !== "" && emailForgetPassword !== "") {
    if (isValidLogin(loginForgetPassword)) {
      if (checkEmail(emailForgetPassword)) {
        sendEmailForgetPassword(loginForgetPassword, emailForgetPassword);
      } else {
        errorMessageEmailingForgetPassword.innerHTML =
          "Merci de rentrer un email valide";
      }
    } else {
      errorMessageEmailingForgetPassword.innerHTML =
        "Merci de rentrer un indentifiant valide";
    }
  } else {
    errorMessageEmailingForgetPassword.innerHTML =
      "Merci de rentrer votre indentifiant et votre email";
  }
}

function sendEmailForgetPassword(loginForgetPassword, emailForgetPassword) {
  let user = {
    loginForgetPassword: loginForgetPassword,
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
        document.querySelector("#errorMessageforgotPassword").innerHTML =
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
      displayUserforgotPassword(JSON.parse(data), loginUser);
    });
}

function displayUserforgotPassword(User, loginUser) {
  let divforgotPassword = document.querySelector(".divRegister");

  divforgotPassword.innerHTML =
    `
  <h1 class="font-bold" style='font-family: "Amatic SC", sans-serif;'>Réinitialiser votre mot de passe</h1>
  
  <div class='divform'>
      <label for="passwordForgotPasswordUser" class='labelforgotPassword labelRegister'>Mot de passe *</label>
      <input type="password" name="passwordForgotPasswordUser" id="passwordForgotPasswordUser" class="inputforgotPassword inputRegister" placeholder='******'>
  </div>

  <div class='divform'>
      <label for="passwordbisForgotPasswordUser" class='labelforgotPassword labelRegister'>Confirmation du mot de passe *</label>
      <input type="password" name="passwordbisForgotPasswordUser" id="passwordbisForgotPasswordUser" class="inputforgotPassword inputRegister" placeholder='******'>
  </div>

  
  <div id="errorMessageUserforgotPassword" class="text-[#ff2727]"></div>
  <div class="divbutton">
      <button type="button" class="btnRegister btnforgotPassword" onclick='changePasswordUserVerification(` +
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

  let errorMessageUserforgotPassword = document.getElementById(
    "errorMessageUserforgotPassword"
  );

  errorMessageUserforgotPassword.innerHTML = "";

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
        errorMessageUserforgotPassword.innerHTML =
          "Le mot de passe doit faire au minimum 6 caractères.";
      }
    } else {
      errorMessageUserforgotPassword.innerHTML =
        "Les mots de passe doivent être identiques.";
    }
  } else {
    errorMessageUserforgotPassword.innerHTML =
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
    .then((data) => reponseforgotPasswordUser(JSON.parse(data)));
}

function reponseforgotPasswordUser(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    setTimeout(() => {
      redirect("login");
    }, 2000);
  } else {
    document.getElementById("errorMessageUserforgotPassword").innerHTML =
      data.message;
  }
}
