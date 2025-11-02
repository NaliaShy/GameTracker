<?php
$host = "localhost";
$user = "root";
$pass = "natalia123"; // o tu contraseña
$db   = "gametracker";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>
