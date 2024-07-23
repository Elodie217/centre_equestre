const months = [
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Août",
  "Septembre",
  "Octobre",
  "Novembre",
  "Décembre",
];

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendarUser");
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
    eventClick: openViewLessonUserModal,
  });
  calendar.render();

  getAllEventsByIdUser().then((events) => {
    calendar.addEventSource(events);
  });
});

function getAllEventsByIdUser() {
  return fetch(HOME_URL + "user/lessons/all")
    .then((res) => res.text())
    .then((data) => {
      let lessons = JSON.parse(data);

      let events = [];

      lessons.forEach((lesson) => {
        events.push({
          date: lesson.date_lesson,
          title: isNull(lesson.title_lesson),
          level: isNull(lesson.all_name_levels),
          id: lesson.id_lesson,
          place: lesson.places_lesson,
          users: isNull(lesson.all_names_user),
        });
      });
      return events;
    });
}

function openViewLessonUserModal(info) {
  let dateLesson = new Date(info.event.start);

  let minutes;
  if (dateLesson.getMinutes() == 0) {
    minutes = "00";
  } else {
    minutes = dateLesson.getMinutes();
  }

  let popup = document.getElementById("eventPopup");
  popup.innerHTML =
    `<h3 class="text-xl mb-4 font-bold">` +
    info.event.title +
    `</h3>
     <p class="italic mb-4">Le ` +
    dateLesson.getDate() +
    ` ` +
    months[dateLesson.getMonth()] +
    ` à ` +
    dateLesson.getHours() +
    `h` +
    minutes +
    `</p>

    <div class='flex'>
    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit mr-2" onclick="openChangeCalendarLessonUserModal(` +
    info.event.id +
    `)">Déplacer</button>

    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit ml-2" onclick="openDeleteLessonUserModal(` +
    info.event.id +
    `, '` +
    info.event.start +
    `')">Annuler</button>
    </div>
                `;
  popup.style.display = "block";
  popup.style.left = `${info.jsEvent.pageX + 10}px`;
  popup.style.top = `${info.jsEvent.pageY + 10}px`;
}

document.addEventListener("click", function (event) {
  let popup = document.getElementById("eventPopup");
  if (
    !popup.contains(event.target) &&
    event.target.className !== "fc-event-title"
  ) {
    popup.style.display = "none";
  }
});

// Change Lesson

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendarUserChangeLesson");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
    locale: "fr",
    headerToolbar: {
      left: "timeGridWeek,dayGridMonth",
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
    },
    allDaySlot: false,
    events: [],
    eventClick: openChangeLessonUserModal,
  });
  calendar.render();

  getAllEventsByLevelUser().then((events) => {
    console.log(events);
    calendar.addEventSource(events);
  });
});

function getAllEventsByLevelUser() {
  return fetch(HOME_URL + "user/lessons/idlevel")
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
          users: usersLesson(lesson.all_names_user),
        });
      });
      return events;
    });
}

let idOldLesson = 0;
function openChangeCalendarLessonUserModal(idLesson) {
  document.getElementById("eventPopup").style.display = "none";
  document
    .querySelector(".modalChangeCalendarLessonUser")
    .classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
  idOldLesson = idLesson;
}

function closeChangeCalendarLessonUserModal() {
  document
    .querySelector(".modalChangeCalendarLessonUser")
    .classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function openChangeLessonUserModal(eventInfo) {
  document.querySelector(".modalChangeLessonUser").classList.remove("hidden");

  let dateLesson = new Date(eventInfo.event.start);

  let minutes;
  if (dateLesson.getMinutes() == 0) {
    minutes = "00";
  } else {
    minutes = dateLesson.getMinutes();
  }

  document.querySelector(".divChangeLessonUser").innerHTML =
    `<p class=" mx-10">Voulez-vous déplacer votre cours au ` +
    dateLesson.getDate() +
    ` ` +
    months[dateLesson.getMonth()] +
    ` à ` +
    dateLesson.getHours() +
    `h` +
    minutes +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#A16C21] text-white border-2 border-[#A16C21] hover:bg-white hover:text-[#A16C21] rounded-xl font-bold" onclick='changeLessonUser(` +
    eventInfo.event.id +
    `)' >Oui</button>
    <button class="p-2 bg-white text-[#A16C21] border-2 border-[#A16C21] hover:bg-[#A16C21] hover:text-white rounded-xl font-bold" onclick=closeChangeLessonUserModal() >Non</button>
  </div>
  `;
}

function closeChangeLessonUserModal() {
  document.querySelector(".modalChangeLessonUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function changeLessonUser(idNewLesson) {
  let lessons = {
    idNewLesson: idNewLesson,
    idOldLesson: idOldLesson,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(lessons),
  };

  fetch(HOME_URL + "user/lessons/change", params)
    .then((res) => res.text())
    .then((data) => {
      reponseChangeLessonUser(JSON.parse(data));
    });
}

function reponseChangeLessonUser(data) {
  console.log(data.message);
  setTimeout(() => {
    location.reload();
  }, 2000);
}

// Delete Lesson

function openDeleteLessonUserModal(idLesson, date) {
  document.getElementById("eventPopup").style.display = "none";

  let dateLesson = new Date(date);

  let minutes;
  if (dateLesson.getMinutes() == 0) {
    minutes = "00";
  } else {
    minutes = dateLesson.getMinutes();
  }

  document.querySelector(".modalDeleteLessonUser").classList.remove("hidden");
  document.querySelector(".divDeleteLessonUser").innerHTML =
    `<p class=" mx-10">Voulez-vous vraiment annuler votre cours du ` +
    dateLesson.getDate() +
    ` ` +
    months[dateLesson.getMonth()] +
    ` à ` +
    dateLesson.getHours() +
    `h` +
    minutes +
    ` ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#A16C21] text-white border-2 border-[#A16C21] hover:bg-white hover:text-[#A16C21] rounded-xl font-bold" onclick='deleteLessonUser(` +
    idLesson +
    `)' >Oui</button>
    <button class="p-2 bg-white text-[#A16C21] border-2 border-[#A16C21] hover:bg-[#A16C21] hover:text-white rounded-xl font-bold" onclick=closeDeleteLessonUserModal() >Non</button>
  </div>
  `;
}

function closeDeleteLessonUserModal() {
  document.querySelector(".modalDeleteLessonUser").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function deleteLessonUser(idLesson) {
  let lesson = {
    idLesson: idLesson,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(lesson),
  };

  fetch(HOME_URL + "user/lessons/delete", params)
    .then((res) => res.text())
    .then((data) => {
      reponseDeleteLessonUser(JSON.parse(data));
    });
}

function reponseDeleteLessonUser(data) {
  openSuccessMessage(data.message);
  setTimeout(() => {
    location.reload();
  }, 2000);
}
