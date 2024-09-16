function openMenu() {
  document.querySelector(".btnOpenMenu").classList.add("hidden");
  document.querySelector(".btnCloseMenu").classList.remove("hidden");
  document.querySelector(".btnsMenu").classList.remove("hidden");
}

function closeMenu() {
  document.querySelector(".btnOpenMenu").classList.remove("hidden");
  document.querySelector(".btnCloseMenu").classList.add("hidden");
  document.querySelector(".btnsMenu").classList.add("hidden");
}

function openDashboard() {
  const sideNav = document.getElementById("sideNav");

  sideNav.classList.remove("hidden");
  document.getElementById("dashboardBtn").classList.add("hidden");
  document.getElementById("btnCloseDashboard").classList.remove("hidden");
}

function closeDashboard() {
  const sideNav = document.getElementById("sideNav");

  sideNav.classList.add("hidden");

  document.getElementById("dashboardBtn").classList.remove("hidden");
  document.getElementById("btnCloseDashboard").classList.add("hidden");
}
