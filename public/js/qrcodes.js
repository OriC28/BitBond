import { getQrcodes } from "./api.js";

document.addEventListener("DOMContentLoaded", async function () {
  const qrList = document.getElementById("qr-list");

  // Datos de ejemplo (simulando respuesta de la base de datos)
  const qrCodes = await getQrcodes();

  // Mostrar QR en la cuadrícula
  function renderQRCodes(qrsToRender) {
    qrList.innerHTML = "";

    qrsToRender.forEach((qr) => {
      const qrCard = document.createElement("div");
      qrCard.className = "qr-card";

      qrCard.innerHTML = `
        <div class="qr-image">
          <img src="${qr.image}" alt="QR Code" width="200" height="200">
        </div>
        <div class="qr-content">${
          qr.text.length > 30 ? qr.text.substring(0, 30) + "..." : qr.text
        }</div>
        <div class="qr-date">${qr.created_at.slice(0, 10)} • ${
        qr.downloads ?? 0
      } descargas</div>
        <div class="qr-actions">
          <button class="btn btn-primary btn-sm download-btn" data-id="${
            qr.id
          }" title="Descargar">
            <i class="fas fa-download"></i>
          </button>
          <button class="btn btn-danger btn-sm delete-btn" data-id="${
            qr.id
          }" title="Eliminar">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      `;

      qrList.appendChild(qrCard);
    });

    addEventListeners();
  }

  // Agregar event listeners a los botones
  function addEventListeners() {
    // Botones de descargar
    document.querySelectorAll(".download-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        const qrId = this.getAttribute("data-id");
        alert(`Descargando QR ${qrId} (simulación)`);
      });
    });

    // Botones de eliminar
    document.querySelectorAll(".delete-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        const qrId = this.getAttribute("data-id");
        if (confirm("¿Estás seguro de eliminar este código QR?")) {
          alert(`QR ${qrId} eliminado (simulación)`);
          // En una implementación real, aquí harías una petición al backend para eliminar
        }
      });
    });
  }

  // Búsqueda/filtrado
  document.getElementById("search-qrs").addEventListener("input", function () {
    const searchTerm = this.value.toLowerCase();
    const filteredQRs = qrCodes.filter((qr) =>
      qr.content.toLowerCase().includes(searchTerm)
    );
    renderQRCodes(filteredQRs);
  });

  // Cargar datos iniciales
  renderQRCodes(qrCodes);
});
