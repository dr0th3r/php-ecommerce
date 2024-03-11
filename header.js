const hamburger = document.querySelector(".hamburger");
const headerLinks = document.querySelector(".header-links");

hamburger.addEventListener("click", () => {
  console.log("clicked");
  hamburger.classList.toggle("is-active");
  headerLinks.classList.toggle("is-active");
});

const toggleDropdownBtn = document.getElementById("toggle-dropdown-btn");
const dropdown = document.querySelector(".dropdown");

toggleDropdownBtn.addEventListener("click", () => {
  dropdown.classList.toggle("is-active");
});

const changeNameBtn = document.querySelector(".change-name-btn");
const changeNameForm = document.querySelector(".change-name-form");
const cancleChangeNameBtn = document.querySelector(".cancel-change-name-btn");

changeNameBtn.addEventListener("click", () => {
  changeNameBtn.classList.remove("is-active");
  changeNameForm.classList.add("is-active");
});

cancleChangeNameBtn.addEventListener("click", () => {
  changeNameBtn.classList.add("is-active");
  changeNameForm.classList.remove("is-active");
});
