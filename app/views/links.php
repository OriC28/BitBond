<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ver Links - Acortador de URL</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/links.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php require_once "sidebar.php"; ?>
  <div class="main-content">
    <div class="header">
      <h2>Links Acortados</h2>
      <div class="search-filter">
        <input
          type="text"
          id="search-links"
          class="form-control"
          placeholder="Buscar links..." />
        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
      </div>
    </div>

    <div class="card">
      <div class="table-responsive">
        <table class="links-table">
          <thead>
            <tr>
              <th>URL Corta</th>
              <th>URL Original</th>
              <th>Fecha</th>
              <th>Clicks</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="links-list">
            <!-- Los links se cargarán dinámicamente -->
          </tbody>
        </table>
      </div>

      <div class="pagination">
        <button class="btn"><i class="fas fa-chevron-left"></i></button>
        <span>Página 1 de 5</span>
        <button class="btn"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </div>

  <script src="../js/main.js"></script>
  <script src="../js/links.js"></script>
</body>

</html>