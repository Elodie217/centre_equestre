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
    events: getAllEvents(),
    eventClick: addLesson(),
  });
  calendar.render();
});

function getAllEvents() {
  fetch(HOME_URL + "admin/lessons/all")
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      return JSON.parse(data);
    });
}
