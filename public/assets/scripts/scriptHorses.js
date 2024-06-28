getAllHorsesSite();
function getAllHorsesSite() {
  fetch(HOME_URL + "horses/all")
    .then((res) => res.text())
    .then((data) => {
      displayHorsesSite(JSON.parse(data));
    });
}

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
