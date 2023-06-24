const form = document.querySelector("form");
const eField = form.querySelector(".email");
const eInput = eField.querySelector("input");
const pField = form.querySelector(".password");
const pInput = pField.querySelector("input");

form.onsubmit = (e) => {
  e.preventDefault();

  (eInput.value === "") ? eField.classList.add("shake", "error") : checkEmail();
  (pInput.value === "") ? pField.classList.add("shake", "error") : checkPass();

  setTimeout(() => {
    eField.classList.remove("shake");
    pField.classList.remove("shake");
  }, 500);

  eInput.onkeyup = () => {
    checkEmail();
  };
  pInput.onkeyup = () => {
    checkPass();
  };

  function checkEmail() {
    if (eInput.value === "") {
      eField.classList.add("error");
      eField.classList.remove("valid");
      let errorTxt = eField.querySelector(".error-txt");
      errorTxt.innerText = "Username can't be blank";
    } else {
      eField.classList.remove("error");
      eField.classList.add("valid");
    }
  }

  function checkPass() {
    if (pInput.value === "") {
      pField.classList.add("error");
      pField.classList.remove("valid");
    } else {
      pField.classList.remove("error");
      pField.classList.add("valid");
    }
  }

  if (!eField.classList.contains("error") && !pField.classList.contains("error")) {
    // Send form data using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("GET", form.getAttribute("action"), true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Handle the response here if needed
        console.log(xhr.responseText);
      }
    };
    xhr.send();
  }
};
