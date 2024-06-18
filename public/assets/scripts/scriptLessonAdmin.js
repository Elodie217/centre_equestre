document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "fr",
    headerToolbar: {
      left: "timeGridDay,timeGridWeek,dayGridMonth",
      center: "title",
      right: "today prev,next",
    },
    editable: false,
    selectable: true,
    firstDay: 1,
    buttonText: {
      today: "Aujourd'hui",
      month: "Mois",
      week: "Semaine",
      day: "Jour",
    },
    allDayText: "Toute la journée",
    events: [],
    dateClick: openAddLessonModal,
    eventClick: viewLesson,
  });
  calendar.render();

  getAllEvents().then((events) => {
    calendar.addEventSource(events);
  });
});

function getAllEvents() {
  return fetch(HOME_URL + "admin/lessons/all")
    .then((res) => res.text())
    .then((data) => {
      let lessons = JSON.parse(data);

      let events = [];

      lessons.forEach((lesson) => {
        events.push({
          date: lesson.date_lesson,
          title: titleLesson(lesson.all_name_levels),
          id: lesson.id_lesson,
          place: lesson.places_lesson,
        });
      });
      return events;
    });
}

function titleLesson(title) {
  if (title == null) {
    return "";
  } else {
    return title;
  }
}

// Add Lesson
function openAddLessonModal(info) {
  getAllLevel();
  getAllUser(0, "checkbox");

  document.querySelector(".modalAddLesson").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  // console.log(info, new Date(info.date));

  // let date = new Date(info.date).toISOString().split("T")[0];
  let hour = new Date(info.date).toTimeString().split(" ")[0];

  document.querySelector("#dateLessonAdd").value = info.dateStr;
  document.querySelector("#hourLessonAdd").value = hour;
}

function closeAddLessonModal() {
  document.querySelector(".modalAddLesson").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function newLessonVerification() {
  let dateLessonAdd = document.getElementById("dateLessonAdd").value;
  let hourLessonAdd = document.getElementById("hourLessonAdd").value;
  let placeLessonAdd = parseInt(
    document.getElementById("placeLessonAdd").value
  );

  let levelsLessonAll = document.querySelectorAll(".levelLessonAdd");
  let levelsLessonAdd = [];
  levelsLessonAll.forEach((element) => {
    if (element.checked) {
      levelsLessonAdd.push(element.value);
    }
  });

  let usersLessonAll = document.querySelectorAll(".userLessonAdd");
  let usersLessonAdd = [];
  usersLessonAll.forEach((element) => {
    if (element.checked) {
      usersLessonAdd.push(element.value);
    }
  });

  let errorMessageLessonAdd = document.getElementById("errorMessageLessonAdd");

  if (dateLessonAdd !== "" && hourLessonAdd !== "" && placeLessonAdd !== "") {
    if (isValidDateFormat(dateLessonAdd)) {
      if (isValidHourFormat(hourLessonAdd)) {
        if (Number(placeLessonAdd) && placeLessonAdd > 0) {
          newLesson(
            dateLessonAdd,
            hourLessonAdd,
            placeLessonAdd,
            levelsLessonAdd,
            usersLessonAdd
          );
        } else {
          errorMessageLessonAdd.innerHTML =
            "Merci de rentrer un nombre de place plus grand que 0.";
        }
      } else {
        errorMessageLessonAdd.innerHTML = "Merci de rentrer une heure valide.";
      }
    } else {
      errorMessageLessonAdd.innerHTML = "Merci de rentrer une date valide.";
    }
  } else {
    errorMessageLessonAdd.innerHTML = "Merci de remplir tous les champs.";
  }
}

function newLesson(
  dateLessonAdd,
  hourLessonAdd,
  placeLessonAdd,
  levelsLessonAdd,
  usersLessonAdd
) {
  let newLesson = {
    dateLessonAdd: dateLessonAdd,
    hourLessonAdd: hourLessonAdd,
    placeLessonAdd: placeLessonAdd,
    levelsLessonAdd: levelsLessonAdd,
    usersLessonAdd: usersLessonAdd,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(newLesson),
  };

  fetch(HOME_URL + "admin/lessons/add", params)
    .then((res) => res.text())
    .then((data) => reponseAddLesson(JSON.parse(data)));
}

function reponseAddLesson(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    getAllEvents();
    closeAddLessonModal();
  } else {
    document.getElementById("errorMessageLessonAdd").innerHTML = data.message;
  }
}

// View Lesson
function openViewLessonModal(info) {
  console.log(info);

  document.querySelector(".modalViewLesson").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

  // document.querySelector(".divViewLesson").innerHTML = "";
}

function closeViewLessonModal() {
  document.querySelector(".modalViewLesson").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}
