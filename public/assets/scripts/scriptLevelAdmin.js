getAllLevel();
function getAllLevel() {
  fetch(HOME_URL + "admin/levels/all")
    .then((res) => res.text())
    .then((data) => {
      displayLevel(JSON.parse(data));
    });
}

function displayLevel(levels) {
  document.querySelector(".divAddLessonLevel").innerHTML = "";

  levels.forEach((level) => {
    document.querySelector(".divAddLessonLevel").innerHTML +=
      ` 
    <div class='mx-2'>
    <input type="checkbox" value=` +
      level.id_level +
      ` class="levelLessonAdd" id=` +
      level.id_level +
      ` name="levelLessonAdd" />
    <label for="levelLessonAdd">` +
      level.name_level +
      `</label>
      </div>`;
  });
}
