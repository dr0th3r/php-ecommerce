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
