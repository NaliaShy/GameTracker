<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=gametracker;charset=utf8",
        "root",
        "natalia123"
    );

    // Modo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
