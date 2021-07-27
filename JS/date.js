"use strict";
///////////////
const dateEl = document.getElementById("date");
const date = new Date();
console.log(date.getFullYear());
dateEl.textContent = `${date.getFullYear()}`;
