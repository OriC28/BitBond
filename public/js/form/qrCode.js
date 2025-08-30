import { saveQRCode } from "../api.js";

const resultContainer = document.getElementById("result-container");
const resultContent = document.getElementById("result-content");

async function generateQRCode(e) {
  e.preventDefault();

  const qrContent = document.getElementById("qr-content").value;

  if (!qrContent) {
    alert("Por favor ingresa una URL o texto válido");
    return;
  }
  const data = await saveQRCode(qrContent);
  displayQrCode(data.file_name);
}

function displayQrCode(fileName) {
  resultContent.innerHTML = `
        <div class="qr-preview">
          <img src="${fileName}" width="180" height="180" alt="QR Code">
        </div>
        <div class="action-buttons">
          <button class="btn btn-primary download-qr">
            <i class="fas fa-download"></i> Descargar QR
          </button>
        </div>
      `;

  resultContainer.style.display = "block";

  // Simular descarga
  document.querySelector(".download-qr").addEventListener("click", function () {
    alert("QR descargado (simulación)");
  });
}

export default generateQRCode;
