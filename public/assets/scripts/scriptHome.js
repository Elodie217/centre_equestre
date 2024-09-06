function getSoon() {
  fetch(HOME_URL + "siteSoon/all")
    .then((res) => res.text())
    .then((data) => {
      displaySoonSite(JSON.parse(data));
    });
}

function displaySoonSite(data) {
  console.log(data);

  data.forEach((element) => {
    if (element.element_site == "title_soon") {
      document.getElementById("SoonSiteTitle").innerHTML =
        element.description_site;
    } else if (element.element_site == "date_soon") {
      document.getElementById("SoonSiteDate").innerHTML =
        element.description_site;
    } else if (element.element_site == "description_soon") {
      document.getElementById("SoonSiteDescription").innerHTML =
        element.description_site;
    } else if (element.element_site == "image_soon") {
      document.getElementById("SoonSiteImg").src = element.description_site;
    }
  });
}
