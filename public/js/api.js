export async function saveUrlShort(originalUrl) {
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
    return data.short_url;
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
    alert(
      "Ocurrió un error al procesar la URL. Por favor, intenta nuevamente."
    );
  }
}

export async function saveQRCode(qrContent) {
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
    return data;
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
    alert(
      "Ocurrió un error al procesar el contenido. Por favor, intenta nuevamente."
    );
  }
}

export async function getUrls() {
  try {
    const response = await fetch("/api/links");
    if (!response.ok) {
      throw new Error(`Error HTTP: ${response.status}`);
    }
    const data = await response.json();
    return data.urls;
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
    alert(
      "Ocurrió un error al obtener las URLs. Por favor, intenta nuevamente."
    );
  }
}
