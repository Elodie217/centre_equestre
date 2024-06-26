function btnLogin() {
  window.location.href = HOME_URL + `login`;
}

function loginVerification() {
  let login = document.getElementById("login").value;
  let passwordLogin = document.getElementById("passwordLogin").value;
  let errorMessageLogin = document.getElementById("errorMessageLogin");

  errorMessageLogin.innerHTML = "";

  if (login !== "" && passwordLogin !== "") {
    loginConnection(login, passwordLogin);
  } else {
    errorMessageLogin.innerHTML = "Merci de remplir tous les champs.";
  }
}

function loginConnection(login, passwordLogin) {
  let Login = {
    login: login,
    passwordLogin: passwordLogin,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Login),
  };

  fetch(HOME_URL + "login/connection", params)
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      reponseLogin(JSON.parse(data));
    });
}

function reponseLogin(data) {
  if (data.status == "success") {
    if (data.role == "User") {
      console.log("User");
      window.location.href = HOME_URL + `user/lessons`;
    } else if (data.role == "Admin") {
      console.log("admin");
      window.location.href = HOME_URL + `admin/lessons`;
    }
  } else {
    document.getElementById("errorMessageLogin").innerHTML = data.message;
  }
}

function logout() {
  fetch(HOME_URL + "logout")
    .then((res) => res.text())
    .then((data) => {
      if (data) {
        window.location.href = HOME_URL + ``;
      }
    });
}
