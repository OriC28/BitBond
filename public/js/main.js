// Funcionalidad común para todas las páginas
document.addEventListener("DOMContentLoaded", function () {
  // Marcar el elemento activo del menú
  const currentPage = window.location.pathname.split("/").pop().split(".")[0];
  const menuItems = document.querySelectorAll(".sidebar-menu a");

  menuItems.forEach((item) => {
    const itemPage = item.getAttribute("href").split(".")[0];
    if (
      currentPage === itemPage ||
      (currentPage === "index" && itemPage === "")
    ) {
      item.classList.add("active");
    }
  });

  // Toggle sidebar en móviles
  const sidebarToggle = document.querySelector(".sidebar-toggle");
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
      document.querySelector(".sidebar").classList.toggle("active");
    });
  }
});
