function getAllLevel(idLevelGiven = 0, div = "select", action = "add") {
  fetch(HOME_URL + "admin/levels/all")
    .then((res) => res.text())
    .then((data) => {
      if (div == "select") {
        displayLevel(JSON.parse(data), idLevelGiven);
      } else if (div == "checkbox") {
        displayLevelCheckbox(JSON.parse(data), idLevelGiven, action);
      }
    });
}

function displayLevel(levels, idLevelUser) {
  divUserLevel = document.querySelectorAll(".levelUser");
  divUserLevel.forEach((div) => {
    div.innerHTML =
      "<option value='' class='mb-3 block text-base font-medium text-[#07074D]'></option>";
  });

  levels.forEach((level) => {
    divUserLevel.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        level.id_level +
        ` class='mb-3 block text-base font-medium text-[#07074D]'
      ` +
        isSelected(idLevelUser, level.id_level) +
        `
      >` +
        level.name_level +
        ` </option>`;
    });
  });
}

function displayLevelCheckbox(levels, idLevelGiven, action) {
  let divLessonLevel;
  if (action == "add") {
    divLessonLevel = document.querySelectorAll(".divLessonLevel");
  } else {
    divLessonLevel = document.querySelectorAll(".divLessonLevelEdit");
  }

  divLessonLevel.forEach((div) => {
    div.innerHTML = "";
  });

  levels.forEach((level) => {
    divLessonLevel.forEach((div) => {
      div.innerHTML +=
        ` 
    <div class='mx-2'>
    <input type="checkbox" value=` +
        level.id_level +
        ` class="levelLessonAdd" id=` +
        level.id_level +
        ` name="levelLessonAdd" ` +
        isCheckedLevel(idLevelGiven, level.name_level) +
        `/>
    <label for="levelLessonAdd">` +
        level.name_level +
        `</label>
      </div>`;
    });
  });
}

function isCheckedLevel(idLevelGiven, idLevelBdd) {
  console.log(idLevelGiven, idLevelBdd);
  if (idLevelGiven !== 0) {
    let idLevels = idLevelGiven.split(", ");
    let isChecked = "";

    idLevels.forEach((idLevel) => {
      if (idLevel == idLevelBdd) {
        isChecked = "checked";
      }
    });

    return isChecked;
  }
}
