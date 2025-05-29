<?php
$host = "10.0.26.10";
$user = "tugi_user";
$pass = "TurvalineParool123!";
$dbname = "kasutajatugi_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}
?>

