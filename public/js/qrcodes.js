document.addEventListener("DOMContentLoaded", function () {
  const qrList = document.getElementById("qr-list");

  // Datos de ejemplo (simulando respuesta de la base de datos)
  const qrCodes = [
    {
      id: 1,
      content: "https://www.ejemplo.com/pagina-muy-larga",
      color: "#000000",
      date: "2023-05-15",
      downloads: 5,
    },
    {
      id: 2,
      content: "https://www.otro-ejemplo.com/articulo",
      color: "#324a5f",
      date: "2023-05-10",
      downloads: 3,
    },
    {
      id: 3,
      content: "https://sitio-web.com/producto/12345",
      color: "#1b2a41",
      date: "2023-05-01",
      downloads: 8,
    },
    {
      id: 4,
      content: "Información de contacto: Juan Pérez - 555-1234",
      color: "#000000",
      date: "2023-04-28",
      downloads: 2,
    },
  ];

  // Mostrar QR en la cuadrícula
  function renderQRCodes(qrsToRender) {
    qrList.innerHTML = "";

    qrsToRender.forEach((qr) => {
      const qrCard = document.createElement("div");
      qrCard.className = "qr-card";

      qrCard.innerHTML = `
        <div class="qr-image">
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(
            qr.content
          )}&color=${qr.color.substring(1)}" alt="QR Code">
        </div>
        <div class="qr-content">${
          qr.content.length > 30
            ? qr.content.substring(0, 30) + "..."
            : qr.content
        }</div>
        <div class="qr-date">${qr.date} • ${qr.downloads} descargas</div>
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
