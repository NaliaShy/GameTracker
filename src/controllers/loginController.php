<?php
session_start();
require_once __DIR__ . '/../database/conexion.php';

$pdo = getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario_email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // ... (Tu lógica de detección de mayúsculas y minúsculas de la columna 'usuario_password' OMITIDA) ...
    $columnaPassword = 'usuario_password'; // Asumiendo que la columna es esta

    // Si el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($password, $usuario[$columnaPassword])) {
        
        // --- MODIFICACIÓN CLAVE AQUÍ ---
        
        // Guardar los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['usuario_id'];
        $_SESSION['usuario_nombre'] = $usuario['usuario_nombre'];
        
        // ¡AGREGAR EL ROL_ID A LA SESIÓN!
        $_SESSION['rol_id'] = $usuario['rol_id']; 
        
        // ---------------------------------
        
        echo "OK"; // Solo esto
        exit();    // Terminar ejecución aquí
    } else {
        echo "Correo o contraseña incorrectos";
        exit();
    }
}
?>