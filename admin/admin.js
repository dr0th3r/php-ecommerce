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

//create product

const createProductDialog = document.getElementById("create-product-dialog");
const createProductBtn = document.getElementById("create-product-btn");

createProductBtn.addEventListener("click", () => {
  createProductDialog.show();
});

//update product

const productList = document.querySelector(".product-list");

const updateProductDialog = document.getElementById("update-product-dialog");
//inputs
const updateProductId = document.getElementById("update-product-id");
const updateProductName = document.getElementById("update-product-name");
const updateProductDescription = document.getElementById(
  "update-product-description"
);
const updateProductPrice = document.getElementById("update-product-price");
const updateProductBrandId = document.getElementById("update-product-brand-id");

productList.addEventListener("click", (e) => {
  const btn = e.target.closest(".update-product-btn");
  if (!btn) return;

  const productId = btn.id;

  const url = `/ecommerce/admin/get_product.php?id=${productId}`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      updateProductId.value = data.id;
      updateProductName.value = data.name;
      updateProductDescription.value = data.description;
      updateProductPrice.value = data.price;
      updateProductBrandId.value = data.brand_id;
      updateProductDialog.show();
    })
    .catch((error) => console.log(error));
});
