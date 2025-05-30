<?php include('includes/header.php'); include('includes/db.php');

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nimi = trim($_POST['nimi']);
    $osakond = trim($_POST['osakond']);
    $kontakt = trim($_POST['kontakt']);
    $probleem = trim($_POST['probleem']);

    if ($nimi && $osakond && $kontakt && $probleem) {
        $stmt = $conn->prepare("INSERT INTO probleemid (nimi, osakond, kontakt, probleem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nimi, $osakond, $kontakt, $probleem);
        $stmt->execute();
        echo "<div class='alert alert-success'>Probleem saadetud!</div>";
        $stmt->close();
    } else {
        $error = "Kõik väljad on kohustuslikud!";
    }
}
?>

<div class="container my-4">
  <h2>Esita probleem</h2>
  <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nimi</label>
      <input type="text" name="nimi" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Osakond</label>
      <input type="text" name="osakond" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Kontakt</label>
      <input type="text" name="kontakt" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Probleemi kirjeldus</label>
      <textarea name="probleem" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100">Saada</button>
  </form>
</div>

<?php include('includes/footer.php'); ?>

