const sideMenu = document.querySelector("aside"); 
const menuBtn = document.querySelector("menu-btn"); 
const closeBtn = document.querySelector("#close-btn"); 


closeBtn.addEventListener('click', () =>{
    sideMenu.style.display='none';
})

function openForm() { 
  
    document.getElementById("form-popup").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("form-popup").style.display = "none";
  }
  
  function hidePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
  }
  
const invoiceButton = document.getElementById("invoice-button");
const addContractButton = document.getElementById("addContract");
const editButtin = document.getElementById("edit-button");
const invoicePopup = document.querySelector(".form-popup");
const addTenant = document.getElementById("addtenant-button");

document.querySelector('.popup').style.display = 'none';

function openPopup() {
  invoicePopup.classList.add("show");
}

function closePopup() {
  invoicePopup.classList.remove("show");
}

invoiceButton.addEventListener("click", openPopup);
addTenant.addEventListener("click", openPopup);

//search for options
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}


const editBtn = document.getElementById("editBtn");
const menu = document.getElementById("menu");

// Add a click event listener to the button
editBtn.addEventListener("click", () => {
  // Toggle the visibility of the menu
  menu.classList.toggle("hidden");
});


function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
 