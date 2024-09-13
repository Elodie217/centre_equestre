function openMenu() {
    document.querySelector('.btnOpenMenu').classList.add('hidden');
    document.querySelector('.btnCloseMenu').classList.remove('hidden');
    document.querySelector('.btnsMenu').classList.remove('hidden');
}

function closeMenu() {
    document.querySelector('.btnOpenMenu').classList.remove('hidden');
    document.querySelector('.btnCloseMenu').classList.add('hidden');
    document.querySelector('.btnsMenu').classList.add('hidden');
}
