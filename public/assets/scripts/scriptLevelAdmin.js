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
      "<option value='' class='mb-3 block text-base font-medium  '></option>";
  });

  levels.forEach((level) => {
    divUserLevel.forEach((div) => {
      div.innerHTML +=
        `
      <option value=` +
        level.id_level +
        ` class='mb-3 block text-base font-medium'
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
  let divAddLevel;
  if (action == "add") {
    divLessonLevel = document.querySelectorAll(".divLessonLevel");
    divAddLevel = document.querySelectorAll(".divAddLevelDisplay");
  } else {
    divLessonLevel = document.querySelectorAll(".divLessonLevelEdit");
    divAddLevel = document.querySelectorAll(".divAddLevelEditDisplay");
  }

  divLessonLevel.forEach((div) => {
    div.innerHTML = "";
  });
  divAddLevel.forEach((div) => {
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

    divAddLevel.forEach((div) => {
      div.innerHTML +=
        `
    <div class="flex justify-between">
      <p>` +
        level.name_level +
        `</p>
      <div>
        <button onclick="deleteLevelValidation(` +
        level.id_level +
        `, '` +
        idLevelGiven +
        `', '` +
        action +
        `')">
              <i class="fa-solid fa-minus mx-2"></i>
          </button>
      </div>
    </div>
    `;
    });
  });
}

function isCheckedLevel(idLevelGiven, idLevelBdd) {
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

function openAddLevel(route = "add") {
  if (route == "add") {
    document.querySelector(".divAddLevel").classList.toggle("hidden");
  } else {
    document.querySelector(".divAddLevelEdit").classList.toggle("hidden");
  }
}

function addLevel(idLevel = 0, div = "add") {
  let newLevel = document.getElementById("inputNewLevel").value;
  let errorMessageLevelAdd = document.querySelector(".errorMessageLevelAdd");

  if (div == "add") {
    newLevel = document.getElementById("inputNewLevel").value;
    errorMessageLevelAdd = document.querySelector(".errorMessageLevelAdd");
  } else {
    newLevel = document.getElementById("inputNewLevelEdit").value;
    errorMessageLevelAdd = document.querySelector(".errorMessageLevelAddEdit");
  }

  if (newLevel !== "") {
    if (newLevel.length < 50) {
      let addLevel = {
        nameLevel: newLevel,
      };

      let params = {
        method: "POST",
        headers: {
          "Content-Type": "application/json; charset=utf-8",
        },
        body: JSON.stringify(addLevel),
      };

      fetch(HOME_URL + "admin/levels/add", params)
        .then((res) => res.text())
        .then((data) => reponseAddLevel(JSON.parse(data), idLevel, div));
    } else {
      errorMessageLevelAdd.innerHTML =
        "Le niveau ne doit pas faire plus de 50 caractère.";
    }
  } else {
    errorMessageLevelAdd.innerHTML = "Merci de remplir le niveau.";
  }
}

function reponseAddLevel(data, idLevel, div) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    if (div == "add") {
      getAllLevel(0, "checkbox");
    } else {
      getAllLevel(idLevel, "checkbox", "edit");
    }
  } else {
    document.getElementById("errorMessageLevelAdd").innerHTML = data.message;
  }
}

function deleteLevelValidation(idLevelDelete, idLevel = 0, div = "add") {
  let text =
    "Êtes-vous sûr(e) de vouloir supprimer ce niveau ? \n Tous les cavaliers associés perdront leur niveau actuel.";
  if (confirm(text) == true) {
    deleteLevel(idLevelDelete, idLevel, div);
  }
}

function deleteLevel(idLevelDelete, idLevel, div) {
  let level = {
    idLevelDelete: idLevelDelete,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(level),
  };

  fetch(HOME_URL + "admin/levels/delete", params)
    .then((res) => res.text())
    .then((data) => {
      reponseAddLevel(JSON.parse(data), idLevel, div);
    });
}
