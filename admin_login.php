<?php
session_start();

include('includes/header.php');

// Admini parool (hashi loomiseks kasuta password_hash)
$admin_hash = '$2y$10$cGF0YnDw0NJEIKB4E2vsK.dFP5U5u5UysCwBmvMkrrf17XwPh76ne'; // parool: admin123

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (password_verify($_POST['password'], $admin_hash)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Vale parool!";
    }
}
?>

<form method="post" style="max-width:400px;margin:auto;">
  <h3>Admini sisselogimine</h3>
  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <div class="mb-3">
    <input type="password" name="password" class="form-control" placeholder="Sisesta parool" required>
  </div>
  <button type="submit" class="btn btn-primary">Logi sisse</button>
</form>

<?php include('includes/footer.php'); ?>
