<?php
// 1. Verificar si el usuario ha iniciado sesión.
if (!isset($_SESSION['usuario_id'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio o login.
    header('Location: /index.php');
    exit();
}

// 2. Verificar si el rol es el de Administrador (rol_id = 2).
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 2) {
    // Si no es un administrador, redirigir o mostrar un mensaje de acceso denegado.
    header('Location: /index.php?error=acceso_denegado');
    exit();
}

// --- A PARTIR DE AQUÍ COMIENZA EL CÓDIGO HTML Y PHP DEL PANEL DE ADMINISTRACIÓN ---

$nombre_admin = htmlspecialchars($_SESSION['usuario_nombre']);

?>