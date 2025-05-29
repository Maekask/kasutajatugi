<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

include('includes/header.php');
include('includes/db.php');

// Tegevused: märgi tehtuks või kustuta
if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    $conn->query("UPDATE probleemid SET staatus='lahendatud' WHERE id=$id");
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM probleemid WHERE id=$id");
}

// Statistika
$total = $conn->query("SELECT COUNT(*) FROM probleemid")->fetch_row()[0];
$solved = $conn->query("SELECT COUNT(*) FROM probleemid WHERE staatus='lahendatud'")->fetch_row()[0];
$unsolved = $total - $solved;

// Andmed
$result = $conn->query("SELECT * FROM probleemid ORDER BY created_at DESC");
?>

<h2>Administreerimisliides</h2>
<p><strong>Kokku pöördumisi:</strong> <?= $total ?> | 
<strong>Lahendatud:</strong> <?= $solved ?> | 
<strong>Lahendamata:</strong> <?= $unsolved ?></p>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th><th>Nimi</th><th>Osakond</th><th>Kontakt</th><th>Probleem</th><th>Staatus</th><th>Tegevused</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['nimi']) ?></td>
      <td><?= htmlspecialchars($row['osakond']) ?></td>
      <td><?= htmlspecialchars($row['kontakt']) ?></td>
      <td><?= nl2br(htmlspecialchars($row['probleem'])) ?></td>
      <td>
        <?= $row['staatus'] == 'lahendatud' ? '<span class="badge bg-success">Tehtud</span>' : '<span class="badge bg-warning text-dark">Lahendamata</span>' ?>
      </td>
      <td>
        <?php if ($row['staatus'] !== 'lahendatud'): ?>
          <a href="?done=<?= $row['id'] ?>" class="btn btn-sm btn-success">Märgi tehtuks</a>
        <?php endif; ?>
        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Kustutada pöördumine?')">Kustuta</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include('includes/footer.php'); ?>

