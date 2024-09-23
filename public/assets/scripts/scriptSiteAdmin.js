function getSite(divDisplay = "View") {
  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "GET",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
  };

  fetch(HOME_URL + "admin/site/all", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        if (divDisplay == "View") {
          displaySiteAdmin(JSON.parse(data));
        } else if (divDisplay == "edit") {
          displaySoonSiteEdit(JSON.parse(data));
        }
      }
    });
}

function displaySiteAdmin(data) {
  data.forEach((element) => {
    if (element.element_site == "title_soon") {
      document.getElementById("AdminSoonSiteTitle").innerHTML =
        element.description_site;
    } else if (element.element_site == "date_soon") {
      document.getElementById("AdminSoonSiteDate").innerHTML =
        element.description_site;
    } else if (element.element_site == "description_soon") {
      document.getElementById("AdminSoonSiteDescription").innerHTML =
        element.description_site;
    } else if (element.element_site == "image_soon") {
      document.getElementById("AdminSoonSiteImg").src =
        element.description_site;
    }
  });
}

function openEditSoonModal() {
  document.querySelector(".modalEditSoon").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
  getSite("edit");
}

function closeEditSoonModal() {
  document.querySelector(".modalEditSoon").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function displaySoonSiteEdit(data) {
  data.forEach((element) => {
    let description = decodeHtml(element.description_site);

    if (element.element_site == "title_soon") {
      document.getElementById("titleEditSoon").value = description;
    } else if (element.element_site == "date_soon") {
      document.getElementById("dateEditSoon").value = description;
    } else if (element.element_site == "description_soon") {
      document.getElementById("descriptionEditSoon").value = description;
    } else if (element.element_site == "image_soon") {
      document.getElementById("imageEditSoon").value = description;
    }
  });
}

function editSoonVerification() {
  let titleEditSoon = document.getElementById("titleEditSoon").value;
  let dateEditSoon = document.getElementById("dateEditSoon").value;
  let descriptionEditSoon = document.getElementById(
    "descriptionEditSoon"
  ).value;
  let imageEditSoon = document.getElementById("imageEditSoon").value;

  let errorMessageEditSoon = document.getElementById("errorMessageEditSoon");

  if (
    titleEditSoon !== "" &&
    dateEditSoon !== "" &&
    descriptionEditSoon !== "" &&
    imageEditSoon !== ""
  ) {
    if (
      titleEditSoon.length <= 1000 &&
      dateEditSoon.length <= 1000 &&
      descriptionEditSoon.length <= 1000 &&
      imageEditSoon.length <= 1000
    ) {
      if (isValidURL(imageEditSoon)) {
        editSoon(
          titleEditSoon,
          dateEditSoon,
          descriptionEditSoon,
          imageEditSoon
        );
      } else {
        errorMessageEditSoon.innerHTML = "Merci de renter un URL valide.";
      }
    } else {
      errorMessageEditSoon.innerHTML =
        "Les informations doivent faire au maximum 1000 caractères.";
    }
  } else {
    errorMessageEditSoon.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editSoon(
  titleEditSoon,
  dateEditSoon,
  descriptionEditSoon,
  imageEditSoon
) {
  let editSite = {
    titleEditSoon: titleEditSoon,
    dateEditSoon: dateEditSoon,
    descriptionEditSoon: descriptionEditSoon,
    imageEditSoon: imageEditSoon,
  };

  let JWTUser = localStorage.getItem("JWTUser");

  let params = {
    method: "POST",
    headers: {
      Authorization: "Bearer " + JWTUser,
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editSite),
  };

  fetch(HOME_URL + "admin/site/edit", params)
    .then((res) => res.text())
    .then((data) => {
      if (JSON.parse(data).message == "JWT incorrect") {
        logout();
      } else {
        reponseEditSoon(JSON.parse(data));
      }
    });
}

function reponseEditSoon(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getSite();
    closeEditSoonModal();
  } else {
    document.getElementById("errorMessageEditSoonUser").innerHTML =
      data.message;
  }
}
