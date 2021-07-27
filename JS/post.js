"use strict";
//Elements
const btnOpenModal = document.querySelector(".modal-open");
const btnCloseModal = document.querySelector(".modal-close");
const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const showNav = document.querySelector(".nav-toggle");
const Navbar = document.querySelector(".nav-list");
const dateEl = document.getElementById("date");
const upvoteCountarr = document.querySelectorAll(".upvote--count");
const upbtnarr = document.querySelectorAll(".upvote--btn");

//// Initial conditions
let upCount = 0;
///////////////////////////
const date = new Date();
console.log(date.getFullYear());
dateEl.textContent = `${date.getFullYear()}`;
///////////////////Functions
// Function to increase and decrease the upvote count(edited)
const funcUpvote = function (e) {
  e.currentTarget.classList.toggle("blue");
};
//Function to show the modal question form
const showModal = function (e) {
  e.preventDefault();
  document.body.classList.add("stop-scrolling");
  modal.classList.remove("hide");
  overlay.classList.remove("hide");
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
//Function to close the modal question form
const closeModal = function (e) {
  e.preventDefault();
  document.body.classList.remove("stop-scrolling");
  modal.classList.add("hide");
  overlay.classList.add("hide");
};
////////////////// Event listeners
showNav.addEventListener("click", function () {
  Navbar.classList.toggle("show");
});
btnOpenModal.addEventListener("click", showModal);
btnCloseModal.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !modal.classList.contains("hide")) {
    closeModal();
  }
});
// Adding event listeners to all btns
upbtnarr.forEach((btn) =>
  btn.addEventListener("click", function (e) {
    funcUpvote(e);
  })
);
//////////// Using intersection API to reveal section
// const revealSection = function (entries, observer) {
//   const [entry] = entries;
//   console.log(entry);
//   if (!entry.isIntersecting) return;
//   entry.target.classList.remove("section--hidden");
// };
// const observer = new IntersectionObserver(revealSection, {
//   root: null,
//   threshold: 0.7,
// });
// document.querySelectorAll(".section").forEach((section) => {
//   observer.observe(section);
//   section.classList.add("section--hidden");
// });
