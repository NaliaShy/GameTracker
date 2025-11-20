<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getConexion() {
    $host = "localhost";
    $dbname = "gametracker";
    $username = "root";
    $password = "natalia123";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("❌ Error de conexión: " . $e->getMessage());
    }
}
?>
