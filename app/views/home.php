<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acortador de URL</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/home.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php require_once "sidebar.php"; ?>
  <div class="main-content">
    <div class="header">
      <h1>Acortador de URL</h1>
    </div>

    <div class="card">
      <div class="toggle-options">
        <div class="toggle-option active" data-option="url">Acortar URL</div>
        <div class="toggle-option" data-option="qr">Generar QR</div>
      </div>

      <form id="url-form" method="post">
        <div class="form-group">
          <label for="original-url">URL original</label>
          <input
            type="url"
            id="original-url"
            class="form-control"
            name="url"
            placeholder="https://ejemplo.com"
            required />
        </div>
        <!--  <div class="form-group">
          <label for="custom-alias">Alias personalizado (opcional)</label>
          <input
            type="text"
            id="custom-alias"
            class="form-control"
            placeholder="ejemplo" />
        </div> -->
        <button type="submit" id="shorten-btn" class="btn btn-primary">
          Acortar URL
        </button>
      </form>

      <form id="qr-form" method="post" style="display: none">
        <div class="form-group">
          <label for="qr-content">Contenido para QR</label>
          <input
            type="text"
            id="qr-content"
            name="content"
            class=" form-control"
            placeholder="URL o texto" />
        </div>
        <button type="submit" id="generate-qr-btn" class="btn btn-primary">
          Generar QR
        </button>
    </div>
    </form>

    <div id="result-container" class="card" style="display: none">
      <h3>Resultado</h3>
      <div id="result-content"></div>
    </div>
  </div>

  <script src="../js/main.js" type="module"></script>
  <script src="../js/home.js" type="module"></script>
</body>

</html>