const resultContainer = document.getElementById("result-container");
const resultContent = document.getElementById("result-content");

async function generateQRCode(e) {
  e.preventDefault();

  const qrContent = document.getElementById("qr-content").value;

  if (!qrContent) {
    alert("Por favor ingresa una URL o texto válido");
    return;
  }

  try {
    const formData = new FormData();
    formData.append("content", qrContent);

    const response = await fetch("/api/qrcodes", {
      method: "POST",
      body: formData,
    });

    console.log("Respuesta del servidor:", response);
    if (!response.ok) {
      throw new Error(`Error HTTP: ${response.status}`);
    }

    const data = await response.json();
    console.log("Datos recibidos:", data);

    displayQrCode(data);
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
    alert(
      "Ocurrió un error al procesar el contenido. Por favor, intenta nuevamente."
    );
  }
}

function displayQrCode(data) {
  resultContent.innerHTML = `
        <div class="qr-preview">
          <img src="${data.file_name}" width="180" height="180" alt="QR Code">
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
