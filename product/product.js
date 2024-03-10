const editReviewBtn = document.getElementById("edit-review-btn");
const cancelUpdateBtn = document.getElementById("cancel-update-btn");
const userReview = document.querySelector(".user-review");
const updateReview = document.querySelector(".update-review");

editReviewBtn.addEventListener("click", () => {
  userReview.classList.remove("is-active");
  updateReview.classList.add("is-active");
});

cancelUpdateBtn.addEventListener("click", () => {
  userReview.classList.add("is-active");
  updateReview.classList.remove("is-active");
});
