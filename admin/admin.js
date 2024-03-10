//create brand
const createBrandBtn = document.getElementById("create-brand-btn");
const createBrandForm = document.getElementById("create-brand-form");
const cancelCreateBrandBtn = document.getElementById("cancel-create-brand-btn");

createBrandBtn.addEventListener("click", () => {
  createBrandBtn.classList.remove("is-active");
  createBrandForm.classList.add("is-active");
});

cancelCreateBrandBtn.addEventListener("click", () => {
  createBrandBtn.classList.add("is-active");
  createBrandForm.classList.remove("is-active");
});

//update brand
const brandList = document.querySelector(".brand-list");

brandList.addEventListener("click", (e) => {
  const btn = e.target.closest(".update-brand-btn");
  if (!btn) return;

  const btnLi = btn.parentElement.parentElement;
  const updateBrandForm = btnLi.nextElementSibling;
  const cancelUpdateBrandBtn = updateBrandForm.querySelector(
    ".cancel-update-brand-btn"
  );

  btnLi.classList.remove("is-active");
  updateBrandForm.classList.add("is-active");

  cancelUpdateBrandBtn.addEventListener("click", () => {
    btnLi.classList.add("is-active");
    updateBrandForm.classList.remove("is-active");
  });
});

//dialog

const createProductDialog = document.getElementById("create-product-dialog");
const createProductBtn = document.getElementById("create-product-btn");

createProductBtn.addEventListener("click", () => {
  createProductDialog.show();
});
