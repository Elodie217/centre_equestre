getAllHorsesSite();
function getAllHorsesSite() {
  fetch(HOME_URL + "horses/all")
    .then((res) => res.text())
    .then((data) => {
      displayHorsesSite(JSON.parse(data));
    });
}

// function displayHorsesSite(Horses) {
//   document.querySelector(".divCardsSite").innerHTML = "";
//   Horses.forEach((horse) => {
//     const birthdateHorse = new Date(horse.birthdate_horse);

//     document.querySelector(".divCardsSite").innerHTML +=
//       `
//     <article class="bg-white h-fit  p-8 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border relative">

//     <div class="relative mb-4 rounded-2xl">
//         <img class=" rounded-2xl min-h-44 max-h-72 mx-auto object-cover transition-transform duration-300 transform group-hover:scale-105" src="` +
//       horse.image_horse +
//       `" alt="Photo de ` +
//       horse.name_horse +
//       `">

//     </div>
//     <div class="flex w-full pb-4 mb-auto">
//         <p class=" font-bold text-xl duration-200 ">` +
//       horse.name_horse +
//       `</p>

//         </div>

//       </article>

//        `;
//   });
// }

function displayHorsesSite(Horses) {
  document.querySelector(".divCardsSite").innerHTML = "";
  Horses.forEach((horse) => {
    document.querySelector(".divCardsSite").innerHTML +=
      `

    <div class=" break-inside-avoid mb-8 relative">
      <img
        class="h-auto max-w-full rounded-lg"
        src="` +
      horse.image_horse +
      `"
        alt="Photo de ` +
      horse.name_horse +
      `"
      />
      <p class='absolute bottom-0 left-0 w-fit bg-[#00000080] text-white px-2 rounded-bl-lg'>` +
      horse.name_horse +
      `</p>
    </div>
        
       `;
  });
}
