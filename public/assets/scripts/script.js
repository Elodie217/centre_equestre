function redirect(url) {
  window.location.href = HOME_URL + url;
}

function openSuccessMessage(message) {
  document.querySelector(".successMessage").innerHTML = message;
  document.querySelector(".toastSuccessMessage").classList.remove("hidden");

  setTimeout(() => {
    closeSuccessMessage();
  }, 5000);
}

function closeSuccessMessage() {
  document.querySelector(".toastSuccessMessage").classList.add("hidden");
}

function isSelected(idGiven, idBdd) {
  if (idGiven == idBdd) {
    return "selected";
  } else {
    return "";
  }
}

function isNull(value, textBefore = "", textAfter = "") {
  if (value == null) {
    return "";
  } else {
    return textBefore + value + textAfter;
  }
}

function isValidDateFormat(dateString) {
  const regex = /^\d{4}-\d{2}-\d{2}$/;
  return regex.test(dateString);
}

function isValidHourFormat(hourString) {
  const regex = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
  return regex.test(hourString);
}

function isValidURL(url) {
  const regex = /^(https?):\/\/[^\s/$.?#].[^\s]*$/i;
  return regex.test(url);
}

function checkEmail(email) {
  let regex =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(email);
}

function isValidPhone(phone) {
  const regex = /^\d{10}$/;
  return regex.test(phone);
}

function isValidLogin(login) {
  const regex = /[A-Za-z0-9-'']+\.[A-Za-z0-9-'']/i;
  return regex.test(login);
}

function decodeHtml(html) {
  var txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
}
