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
    console.log("same", idGiven, idBdd);
    return "selected";
  } else {
    // console.log("Not same", idGiven, idBdd);

    return "";
  }
}

function isNull(value) {
  if (value == null) {
    return "";
  } else {
    return value;
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
  let re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function isValidPhone(phone) {
  const regex = /^\d{10}$/;
  return regex.test(phone);
}
