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
    console.log("Not same", idGiven, idBdd);

    return "";
  }
}

function isValidDateFormat(dateString) {
  const regex = /^\d{4}-\d{2}-\d{2}$/;
  return regex.test(dateString);
}

function isValidURL(url) {
  const regex = /^(https?):\/\/[^\s/$.?#].[^\s]*$/i;
  return regex.test(url);
}
