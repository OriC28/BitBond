import { getUrls } from "./api.js";
import addCopyListeners from "./utils/copy.js";

document.addEventListener("DOMContentLoaded", async function () {
  const linksList = document.getElementById("links-list");

  // Obtener urls de la base de datos
  const links = await getUrls();

  // Mostrar links en la tabla
  function renderLinks(linksToRender) {
    linksList.innerHTML = "";

    linksToRender.forEach((link) => {
      const row = document.createElement("tr");

      row.innerHTML = `
        <td>
          <a href="${link.short_url}" target="_blank">${link.short_url}</a>
          <button class="btn btn-sm copy-btn" data-text="${
            link.short_url
          }" title="Copiar">
            <i class="fas fa-copy"></i>
          </button>
        </td>
        <td class="original-url">${link.long_url}</td>
        <td>${link.created_at.slice(0, 10)}</td>
        <td>${link.clicks ?? 0}</td>
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
    addCopyListeners();

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
