let button = document.querySelector(".btn-show-form");
let forma = document.getElementById("forma");
let buttonEdit = document.getElementById("edit-btn");

button.addEventListener("click", (e) => {
  e.preventDefault();
  forma.classList.toggle("hidden");
});

buttonEdit.addEventListener("click", () => {
  e.preventDefault();
  forma.classList.toggle("hidden");
});
