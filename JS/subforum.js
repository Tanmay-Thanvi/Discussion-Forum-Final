"use strict";
// Elements
const showNav = document.querySelector(".nav-toggle");
const Navbar = document.querySelector(".nav-list");
const dateEl = document.getElementById("date");
const subforumContainer = document.querySelector(".subforum_container");
const toTopBtn = document.querySelector(".top--btn");
///////////////
const date = new Date();
console.log(date.getFullYear());
dateEl.textContent = `${date.getFullYear()}`;
// onscroll
window.onscroll = function () {
  scrollTop();
};
// //////////functions
const scrollTop = function () {
  if (document.body.scrollTop > 65 || document.documentElement.scrollTop > 65) {
    toTopBtn.style.display = "block";
  } else {
    toTopBtn.style.display = "none";
  }
};
// To the top
const toTop = function () {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};

// ////////// Event listeners
showNav.addEventListener("click", function () {
  Navbar.classList.toggle("show");
});
//////////// Using intersection API to reveal section
const revealSection = function (entries, observer) {
  const [entry] = entries;
  console.log(entry);
  if (!entry.isIntersecting) return;
  entry.target.classList.remove("section--hidden");
};
const observer = new IntersectionObserver(revealSection, {
  root: null,
  threshold: 0.1,
});
document.querySelectorAll(".section").forEach((section) => {
  observer.observe(section);
  section.classList.add("section--hidden");
});
