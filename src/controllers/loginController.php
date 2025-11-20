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

    /* Debug
    var_dump("password ingresada:", $password);
    var_dump("usuario:", $usuario);

    if (!$usuario) {
        echo "Correo o contraseña incorrectos";
        exit;
    }
         var_dump("password hash BD:", $usuario[$columnaPassword]);
    */

    // Aquí detectamos cómo viene la columna REAL
    $columnaPassword = null;

    if (isset($usuario['usuario_password'])) {
        $columnaPassword = 'usuario_password';
    }

    if (isset($usuario['usuario_Password'])) {
        $columnaPassword = 'usuario_Password';
    }

    // Si no existe ninguna, error serio
    if (!$columnaPassword) {
        echo "Error: no se encontró la columna de contraseña.";
        exit;
    }



    if (password_verify($password, $usuario[$columnaPassword])) {
    $_SESSION['usuario_id'] = $usuario['usuario_id'];
    $_SESSION['usuario_nombre'] = $usuario['usuario_nombre'];

    echo "OK"; // Solo esto
    exit();     // Terminar ejecución aquí
} else {
    echo "Correo o contraseña incorrectos";
    exit();
}

}
