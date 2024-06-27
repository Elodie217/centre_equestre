function sendContactVerification() {
  let lastnameContact = document.getElementById("lastnameContact").value;
  let firstnameContact = document.getElementById("firstnameContact").value;
  let emailContact = document.getElementById("emailContact").value;
  let messageContact = document.getElementById("messageContact").value;
  let errorMessageContact = document.getElementById("errorMessageContact");
  errorMessageContact.innerHTML = "";

  if (
    lastnameContact !== "" &&
    firstnameContact !== "" &&
    emailContact !== "" &&
    messageContact !== ""
  ) {
    if (lastnameContact.length <= 50) {
      if (firstnameContact.length <= 50) {
        if (messageContact.length <= 500) {
          if (checkEmail(emailContact)) {
            sendContact(
              lastnameContact,
              firstnameContact,
              emailContact,
              messageContact
            );
          } else {
            errorMessageContact.innerHTML = "Merci de rentrer un email valide.";
          }
        } else {
          errorMessageContact.innerHTML =
            "Le message doit faire au maximum 500 caractères.";
        }
      } else {
        errorMessageContact.innerHTML =
          "Votre prénom doit faire au maximum 50 caractères.";
      }
    } else {
      errorMessageContact.innerHTML =
        "Votre nom doit faire au maximum 50 caractères.";
    }
  } else {
    errorMessageContact.innerHTML = "Merci de remplir tous les champs.";
  }
}

function sendContact(
  lastnameContact,
  firstnameContact,
  emailContact,
  messageContact
) {
  let sendContact = {
    lastnameContact: lastnameContact,
    firstnameContact: firstnameContact,
    emailContact: emailContact,
    messageContact: messageContact,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(sendContact),
  };

  fetch(HOME_URL + "contact/send", params)
    .then((res) => res.text())
    .then((data) => reponseSendContact(JSON.parse(data)));
}

function reponseSendContact(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
  } else {
    document.getElementById("errorMessageContact").innerHTML = data.message;
  }
}