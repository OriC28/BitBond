document.addEventListener("DOMContentLoaded", function () {
  const linksList = document.getElementById("links-list");

  // Datos de ejemplo (simulando respuesta de la base de datos)
  const links = [
    {
      shortUrl: "https://short.ly/abc123",
      originalUrl: "https://www.ejemplo.com/pagina-muy-larga/parametros",
      date: "2023-05-15",
      clicks: 42,
    },
    {
      shortUrl: "https://short.ly/def456",
      originalUrl: "https://www.otro-ejemplo.com/articulo/interesante",
      date: "2023-05-10",
      clicks: 18,
    },
    {
      shortUrl: "https://short.ly/ghi789",
      originalUrl: "https://sitio-web.com/producto/12345",
      date: "2023-05-01",
      clicks: 76,
    },
  ];

  // Mostrar links en la tabla
  function renderLinks(linksToRender) {
    linksList.innerHTML = "";

    linksToRender.forEach((link) => {
      const row = document.createElement("tr");

      row.innerHTML = `
        <td>
          <a href="${link.shortUrl}" target="_blank">${link.shortUrl}</a>
          <button class="btn btn-sm copy-btn" data-text="${link.shortUrl}" title="Copiar">
            <i class="fas fa-copy"></i>
          </button>
        </td>
        <td class="original-url">${link.originalUrl}</td>
        <td>${link.date}</td>
        <td>${link.clicks}</td>
        <td>
          <div class="action-buttons">
            <button class="btn btn-primary btn-sm stats-btn" title="Estadísticas">
              <i class="fas fa-chart-bar"></i>
            </button>
            <button class="btn btn-success btn-sm edit-btn" title="Editar">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm delete-btn" title="Eliminar">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </td>
      `;

      linksList.appendChild(row);
    });

    addEventListeners();
  }

  // Agregar event listeners a los botones
  function addEventListeners() {
    // Botones de copiar
    document.querySelectorAll(".copy-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        const text = this.getAttribute("data-text");
        navigator.clipboard.writeText(text).then(() => {
          this.innerHTML = '<i class="fas fa-check"></i>';
          setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy"></i>';
          }, 2000);
        });
      });
    });

    // Botones de estadísticas
    document.querySelectorAll(".stats-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        alert("Mostrando estadísticas (simulación)");
      });
    });

    // Botones de editar
    document.querySelectorAll(".edit-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        const row = this.closest("tr");
        const originalUrl = row.querySelector(".original-url").textContent;
        const newUrl = prompt("Editar URL:", originalUrl);

        if (newUrl && newUrl !== originalUrl) {
          row.querySelector(".original-url").textContent = newUrl;
          alert("URL actualizada (simulación)");
        }
      });
    });

    // Botones de eliminar
    document.querySelectorAll(".delete-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        if (confirm("¿Estás seguro de eliminar este link?")) {
          const row = this.closest("tr");
          row.remove();
          alert("Link eliminado (simulación)");
        }
      });
    });
  }

  // Búsqueda/filtrado
  document
    .getElementById("search-links")
    .addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase();
      const filteredLinks = links.filter(
        (link) =>
          link.shortUrl.toLowerCase().includes(searchTerm) ||
          link.originalUrl.toLowerCase().includes(searchTerm)
      );
      renderLinks(filteredLinks);
    });

  // Cargar datos iniciales
  renderLinks(links);
});
