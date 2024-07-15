// getAllHorsesSite();
function getAllHorsesSite() {
  fetch(HOME_URL + "horses/all")
    .then((res) => res.text())
    .then((data) => {
      displayHorsesSite(JSON.parse(data));
    });
}

function displayHorsesSite(Horses) {
  console.log(Horses);
  document.querySelector(".divCardsSite").innerHTML = "";
  Horses.forEach((horse) => {
    document.querySelector(".divCardsSite").innerHTML +=
      `

    <div class="group/item break-inside-avoid mb-8 relative">
      <img
        class="h-auto max-w-full rounded-lg"
        src="` +
      horse.image_horse +
      `"
        alt="Photo de ` +
      horse.name_horse +
      `"
      />
      <p class="absolute bottom-0 left-0 w-fit bg-[#00000080] text-white px-2 rounded-bl-lg opacity-100 visible transition-opacity duration-300 ease-in-out group-hover/item:opacity-0 group-hover/item:invisible">` +
      horse.name_horse +
      `</p>
      <p class="absolute bottom-0 left-0 w-fit bg-[#00000080] text-white px-2 rounded-bl-lg opacity-0 invisible transition-opacity duration-300 ease-in-out group-hover/item:opacity-100 group-hover/item:visible">` +
      horse.name_horse +
      `</span><br>` +
      ageHorse(horse.birthdate_horse) +
      ` ans` +
      existe(isNull(horse.coat_horse, "Robe : ")) +
      `` +
      existe(isNull(horse.height_horse, "Taille : ", " cm")) +
      `</p>
    </div>
        
       `;
  });
}

function ageHorse(birthdate) {
  let date = new Date(birthdate);
  let diff = Date.now() - date.getTime();
  let age = new Date(diff);
  return Math.abs(age.getUTCFullYear() - 1970);
}

function existe(data) {
  if (data !== "") {
    return "<br>" + data;
  } else {
    return "";
  }
}
