import generateQRCode from "./form/qrCode.js";
import generateUrlShort from "./form/shortUrl.js";

document.addEventListener("DOMContentLoaded", function () {
  const urlForm = document.getElementById("url-form");
  const qrForm = document.getElementById("qr-form");
  const toggleOptions = document.querySelectorAll(".toggle-option");
  const resultContainer = document.getElementById("result-container");

  // Change between forms
  toggleOptions.forEach((option) => {
    option.addEventListener("click", function () {
      toggleOptions.forEach((opt) => opt.classList.remove("active"));
      this.classList.add("active");

      if (this.dataset.option === "url") {
        urlForm.style.display = "block";
        qrForm.style.display = "none";
      } else {
        urlForm.style.display = "none";
        qrForm.style.display = "block";
      }

      resultContainer.style.display = "none";
    });
  });
  // Form events
  urlForm.addEventListener("submit", generateUrlShort);
  qrForm.addEventListener("submit", generateQRCode);
});
