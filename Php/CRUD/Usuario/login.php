<?php
include '../../conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['usuario_email'] ?? '';
    $password = $_POST['usuario_password'] ?? '';

    if (empty($email) || empty($password)) {    
        
        die("⚠️ Faltan datos obligatorios.");
    }

    try {

        // ✅ Ajusta los nombres de TU TABLA EXACTOS
        $sql = "SELECT usuario_id, usuario_nombre, usuario_email, usuario_password, usuario_estado
                FROM usuario
                WHERE usuario_email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {

            if (password_verify($password, $usuario['usuario_password'])) {

                // ✅ Guardar datos en la sesión
                $_SESSION['usuario_id']     = $usuario['usuario_id'];
                $_SESSION['usuario_nombre'] = $usuario['usuario_nombre'];
                $_SESSION['usuario_email']  = $usuario['usuario_email'];
                $_SESSION['usuario_estado'] = $usuario['usuario_estado'];

                echo "✅ Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($usuario['usuario_nombre']) . "!";
                exit();

            } else {
                echo "❌ Contraseña incorrecta.";
                exit();
            }

        } else {
            echo "❌ No existe una cuenta con el correo: $email";
            exit();
        }

    } catch (PDOException $e) {
        echo "❌ Error en la consulta: " . $e->getMessage();
    }
}
?>
