<?php session_start(); ?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasutajatugi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
  <header class="mb-4">
    <img src="../img/banner.jpg" class="img-fluid" alt="Kasutajatugi">
    <h1 class="text-center mt-3">Kasutajatugi</h1>
  </header>

  <!-- NAVBAR ALGUS -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Kasutajatugi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Avaleht</a></li>
          <li class="nav-item"><a class="nav-link" href="uudised.php">Uudised</a></li>
          <li class="nav-item"><a class="nav-link" href="tugileht.php">Tugileht</a></li>
          <li class="nav-item"><a class="nav-link" href="kontakt.php">Kontakt</a></li>
          <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
          <?php if (isset($_SESSION['admin_logged_in'])): ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="logout.php">Logi välja</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- NAVBAR LÕPP -->

  <!-- Siia saad lisada ülejäänud lehe sisu -->

</div>

<!-- Bootstrap JS lõpus (vajalik navbar toggle jaoks) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

