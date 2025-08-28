import addCopyListeners from "../utils/copy.js";

const resultContainer = document.getElementById("result-container");
const resultContent = document.getElementById("result-content");

async function generateUrlShort(e) {
  e.preventDefault();

  const originalUrl = document.getElementById("original-url").value;

  if (!originalUrl) {
    alert("Por favor ingresa una URL válida");
    return;
  }

  try {
    const formData = new FormData();
    formData.append("url", originalUrl);

    const response = await fetch("/api/links", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`Error HTTP: ${response.status}`);
    }

    const data = await response.json();
    console.log("Datos recibidos:", data);

    displayShortUrl(data.short_url);
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
    alert(
      "Ocurrió un error al procesar la URL. Por favor, intenta nuevamente."
    );
  }
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
