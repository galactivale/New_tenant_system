const openBtn = document.getElementById("open-btn");
const popUp = document.getElementById("pop-up");
const closeBtn = document.getElementById("close-btn");

function handleOpenClick() {
  popUp.style.right = "0";
}

function handleCloseClick() {
  popUp.style.right = "-300px";
}

openBtn.addEventListener("click", handleOpenClick);

closeBtn.addEventListener("click", handleCloseClick);
