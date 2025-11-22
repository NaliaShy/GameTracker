<?php
session_start();
require_once __DIR__ . '/../database/conexion.php'; 

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "Debe iniciar sesión para cambiar su avatar.";
    exit;
}

$pdo = getConexion();

// ... [Conexión y verificación de sesión] ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí el controlador extrae el dato enviado por el JavaScript
    $newAvatarPath = trim($_POST['avatarPath'] ?? ''); 
    
    // ... [Validación de seguridad] ...

    // Actualiza la columna 'usuario_avatar' en la base de datos con $newAvatarPath
    $stmt = $pdo->prepare("UPDATE usuario SET usuario_avatar = :path WHERE usuario_id = :id");
    // ...
    
    echo "OK"; // Respuesta enviada de vuelta al JavaScript
}
?>