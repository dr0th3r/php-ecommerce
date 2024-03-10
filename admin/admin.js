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

//dialog

const createProductDialog = document.getElementById("create-product-dialog");
const createProductBtn = document.getElementById("create-product-btn");

createProductBtn.addEventListener("click", () => {
  createProductDialog.show();
});
