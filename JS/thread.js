"use strict";
// Elements
const showNav = document.querySelector(".nav-toggle");
const Navbar = document.querySelector(".nav-list");
const dateEl = document.getElementById("date");
const cancel = document.querySelector(".cancel_btn");
const commentarea = document.querySelector(".comment-area");
///////////////
const date = new Date();
console.log(date.getFullYear());
dateEl.textContent = `${date.getFullYear()}`;
////////////////Functions
const showComment = function () {
  commentarea.classList.toggle("hide");
};

// ////////// Event listeners
showNav.addEventListener("click", function () {
  Navbar.classList.toggle("show");
});
cancel.addEventListener("click", function () {
  commentarea.classList.add("hide");
});
// Intersection API to the page
const revealSection = function (entries, observer) {
  const [entry] = entries;
  console.log(entry);
  if (!entry.isIntersecting) return;
  entry.target.classList.remove("section--hidden");
};
const sectionObserver = new IntersectionObserver(revealSection, {
  root: null,
  threshold: 0.8,
});
document.querySelectorAll(".section").forEach((sec) => {
  sectionObserver.observe(sec);
  sec.classList.add("section--hidden");
});