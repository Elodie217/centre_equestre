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
    eventClick: openViewLessonModal,
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
          users: usersLesson(lesson.all_names_user),
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

function usersLesson(users) {
  if (users == null) {
    return "";
  } else {
    return users;
  }
}

// Add Lesson
function openAddLessonModal(info) {
  getAllLevel(0, "checkbox");
  getAllUserSelect(0, "checkbox");

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

          // let dateHourLesson = dateLessonAdd + " T" + hourLessonAdd;

          // let newLessonCalendar = {
          //   date: dateHourLesson,
          //   title: titleLesson(levelsLessonAdd),
          //   // id: lesson.id_lesson,
          //   place: placeLessonAdd,
          //   users: usersLesson(usersLessonAdd),
          // };
          // calendar.addEvent(newLessonCalendar);
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
    // getAllEvents();
    // closeAddLessonModal();
    setTimeout(() => {
      location.reload();
    }, 2000);
  } else {
    document.getElementById("errorMessageLessonAdd").innerHTML = data.message;
  }
}

// View Lesson
function openViewLessonModal(infos) {
  let eventInfo = infos.event.extendedProps;

  let usersArray = eventInfo.users.split(", ");

  document.querySelector(".modalViewLesson").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");

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

  let dateLesson = new Date(infos.event.start);

  let minutes;
  if (dateLesson.getMinutes() == 0) {
    minutes = "00";
  } else {
    minutes = dateLesson.getMinutes();
  }

  let hours;
  if (dateLesson.getHours() < 10) {
    hours = "0" + dateLesson.getHours();
  } else {
    hours = dateLesson.getHours();
  }

  document.querySelector(".divViewLesson").innerHTML =
    `
  <div>
    <h3 class="text-2xl text-center mb-8 font-bold">` +
    infos.event.title +
    `</h3>
    <p class="italic text-right">Le ` +
    dateLesson.getDate() +
    ` ` +
    months[dateLesson.getMonth()] +
    ` à ` +
    dateLesson.getHours() +
    `h` +
    minutes +
    `</p>
    <p class="my-2"><span class="font-bold">Participants : </span> ` +
    usersLessonsLength(usersArray) +
    `/` +
    eventInfo.place +
    `</p>
    <div class="divViewUsersLessons">

    </div>
  </div>

  <div class="flex justify-around mt-8">
    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openEditLessonModal()">Modifier</button>

    <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="openDeleteLessonModal(` +
    infos.event.id +
    `, '` +
    infos.event.title +
    `')">Supprimer</button>
     </div>
  `;
  document.querySelector(".divViewUsersLessons").innerHTML = "";

  if (usersArray == "") {
    console.log(usersArray);
  } else {
    usersArray.forEach((user) => {
      if (user) {
      }
      document.querySelector(".divViewUsersLessons").innerHTML +=
        `<p>` + user.split(" ")[1] + ` ` + user.split(" ")[2] + `</p>`;
    });
  }

  //Edit modale

  getAllLevel(infos.event.title, "checkbox", "edit");
  getAllUserSelect(eventInfo.users, "checkbox", "edit");

  document.querySelector(".divEditLesson").innerHTML =
    `
   <h3 class="text-2xl text-center mb-8 mx-10">Modifier le cours du ` +
    dateLesson.getDate() +
    ` ` +
    months[dateLesson.getMonth()] +
    ` à ` +
    dateLesson.getHours() +
    `h` +
    minutes +
    `</h3>
   <div class="-mx-3 flex flex-wrap">
       <div class="w-full px-3 sm:w-1/2">
           <div class="mb-5">
               <label for="dateLessonEdit" class='mb-3 block text-base font-medium text-[#07074D]"'>Date</label>
               <input type="date" name="dateLessonEdit" id="dateLessonEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value='` +
    infos.event.startStr.split("T")[0] +
    `'>
           </div>
       </div>
       <div class="w-full px-3 sm:w-1/2">
           <div class="mb-5">
               <label for="hourLessonEdit" class='mb-3 block text-base font-medium text-[#07074D]"'>Heure</label>

               <input type="time" name="hourLessonEdit" id="hourLessonEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"  value='` +
    hours +
    `:` +
    minutes +
    `'>

               </select>
           </div>
       </div>
   </div>


   <div class="-mx-3 flex flex-wrap">
       <div class="w-full px-3 sm:w-1/2">
           <div class="mb-5">
               <div class='mb-3 block text-base font-medium text-[#07074D]"'>Niveau(x)</div>

               <div class="divLessonLevelEdit flex flex-wrap">

               </div>

           </div>
       </div>
       <div class="w-full px-3 sm:w-1/2">
           <div class="mb-5">
               <label for="placeLessonEdit" class='mb-3 block text-base font-medium '>Places</label>
               <input type="number" min=1 name="placeLessonEdit" id="placeLessonEdit" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md" value=` +
    eventInfo.place +
    `>
           </div>
       </div>
   </div>
   <div class="mb-5">
       <p class='mb-3 block text-base font-medium '> Participants</p>
       <div class="divLessonUserEdit flex flex-col h-24 overflow-auto"></div>
   </div>

   <div id="errorMessageLessonEdit"></div>

   <div class="w-fit m-auto mt-8">

       <button type="button" class="text-white hover:bg-gray-50 border-b border-gray-100 md:hover:bg-[#a16c21cc] bg-[#A16C21] hover:bg-[#a16c21cc] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="editLessonVerification(` +
    infos.event.id +
    `)">Modifier</button>
   </div>`;
}

function usersLessonsLength(users) {
  if (users == "") {
    return 0;
  } else {
    return users.length;
  }
}

function closeViewLessonModal() {
  document.querySelector(".modalViewLesson").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

// Edit Lesson
function openEditLessonModal() {
  // getAllLevel();
  // getAllUserSelect(0, "checkbox");

  document.querySelector(".modalEditLesson").classList.remove("hidden");
  document.querySelector(".blurred").classList.remove("hidden");
}

function closeEditLessonModal() {
  document.querySelector(".modalEditLesson").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function editLessonVerification(idLesson) {
  let dateLessonEdit = document.getElementById("dateLessonEdit").value;
  let hourLessonEdit = document.getElementById("hourLessonEdit").value;
  let placeLessonEdit = parseInt(
    document.getElementById("placeLessonEdit").value
  );

  let levelsLessonAll = document.querySelectorAll(".levelLessonAdd");
  let levelsLessonEdit = [];
  levelsLessonAll.forEach((element) => {
    if (element.checked) {
      levelsLessonEdit.push(element.value);
    }
  });

  let usersLessonAll = document.querySelectorAll(".userLessonAdd");
  let usersLessonEdit = [];
  usersLessonAll.forEach((element) => {
    if (element.checked) {
      usersLessonEdit.push(element.value);
    }
  });

  let errorMessageLessonEdit = document.getElementById(
    "errorMessageLessonEdit"
  );

  if (
    dateLessonEdit !== "" &&
    hourLessonEdit !== "" &&
    placeLessonEdit !== ""
  ) {
    if (isValidDateFormat(dateLessonEdit)) {
      if (isValidHourFormat(hourLessonEdit)) {
        if (Number(placeLessonEdit) && placeLessonEdit > 0) {
          editLesson(
            idLesson,
            dateLessonEdit,
            hourLessonEdit,
            placeLessonEdit,
            levelsLessonEdit,
            usersLessonEdit
          );
        } else {
          errorMessageLessonEdit.innerHTML =
            "Merci de rentrer un nombre de place plus grand que 0.";
        }
      } else {
        errorMessageLessonEdit.innerHTML = "Merci de rentrer une heure valide.";
      }
    } else {
      errorMessageLessonEdit.innerHTML = "Merci de rentrer une date valide.";
    }
  } else {
    errorMessageLessonEdit.innerHTML = "Merci de remplir tous les champs.";
  }
}

function editLesson(
  idLesson,
  dateLessonEdit,
  hourLessonEdit,
  placeLessonEdit,
  levelsLessonEdit,
  usersLessonEdit
) {
  let editLesson = {
    idLesson: idLesson,
    dateLessonEdit: dateLessonEdit,
    hourLessonEdit: hourLessonEdit,
    placeLessonEdit: placeLessonEdit,
    levelsLessonEdit: levelsLessonEdit,
    usersLessonEdit: usersLessonEdit,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(editLesson),
  };

  fetch(HOME_URL + "admin/lessons/edit", params)
    .then((res) => res.text())
    .then((data) => reponseEditLesson(JSON.parse(data)));
}

function reponseEditLesson(data) {
  if (data.status == "success") {
    openSuccessMessage(data.message);
    // getAllEvents();
    // closeEditLessonModal();
    setTimeout(() => {
      location.reload();
    }, 2000);
  } else {
    document.getElementById("errorMessageLessonEdit").innerHTML = data.message;
  }
}

// Delete Lesson

function openDeleteLessonModal(idLesson) {
  document.querySelector(".modalViewLesson").classList.add("hidden");

  document.querySelector(".modalDeleteLesson").classList.remove("hidden");
  document.querySelector(".deleteLessonMessage").innerHTML =
    `<p>Voulez-vous vraiment suppimer ce cours ?</p>
  <div class='flex justify-around mt-8'>
    <button class="p-2 bg-[#A16C21] text-white border-2 border-[#A16C21] hover:bg-white hover:text-[#A16C21] rounded-xl font-bold" onclick='deleteLesson(` +
    idLesson +
    `)' >Oui</button>
    <button class="p-2 bg-white text-[#A16C21] border-2 border-[#A16C21] hover:bg-[#A16C21] hover:text-white rounded-xl font-bold" onclick=closeDeleteLessonModal() >Non</button>
  </div>
  `;
}

function closeDeleteLessonModal() {
  document.querySelector(".modalDeleteLesson").classList.add("hidden");
  document.querySelector(".blurred").classList.add("hidden");
}

function deleteLesson(idLesson) {
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

  fetch(HOME_URL + "admin/lessons/delete", params)
    .then((res) => res.text())
    .then((data) => {
      reponseDeleteLesson(JSON.parse(data));
    });
}

function reponseDeleteLesson(data) {
  openSuccessMessage(data.message);
  // closeDeleteLessonModal();
  setTimeout(() => {
    location.reload();
  }, 2000);
}
