import addCopyListeners from "../utils/copy.js";
import { saveUrlShort } from "../api.js";

const resultContainer = document.getElementById("result-container");
const resultContent = document.getElementById("result-content");

async function generateUrlShort(e) {
  e.preventDefault();

  const originalUrl = document.getElementById("original-url").value;

  if (!originalUrl) {
    alert("Por favor ingresa una URL válida.");
    return;
  }
  const shortUrl = await saveUrlShort(originalUrl);
  displayShortUrl(shortUrl);
}

function displayShortUrl(shortUrl) {
  resultContent.innerHTML = `
        <div class="short-url-result">
          <input type="text" class="form-control" value="${shortUrl}" readonly>
          <button class="btn btn-primary copy-btn" data-text="${shortUrl}">
            <i class="fas fa-copy"></i>
          </button>
        </div>
        <div class="action-buttons">
          <button class="btn btn-success">
            <i class="fas fa-chart-bar"></i> Estadísticas
          </button>
          <button class="btn btn-primary">
            <i class="fas fa-qrcode"></i> Generar QR
          </button>
        </div>
      `;

  resultContainer.style.display = "block";
  addCopyListeners();
}

export default generateUrlShort;
