"use strict";
const threadcontainer = document.querySelector(".thread_container");
const alertCloseBtn = document.querySelector(".alert__button--close");
const alertContainer = document.querySelector(".alert__container");
const alertTitle = document.getElementById("alert__title");
const alertPara = document.getElementById("alert__p");
const alertInfo = document.querySelector(".alert__info");

const showMessage = function () {
  alertContainer.classList.add("show__notification");
  alertCloseBtn.addEventListener("click", function () {
    alertContainer.classList.remove("show__notification");
  });
};
showMessage()

// let state;
// const showAlert = function (state) {
//   if (null ?? state) {
//     showMessage();
//   } else {
//     showMessage();
//     alertContainer.classList.add("failure");
//     alertTitle.innerText = "Failure";
//     alertPara.innerText = "Hello world";
//   }
// };

// console.log(state);
