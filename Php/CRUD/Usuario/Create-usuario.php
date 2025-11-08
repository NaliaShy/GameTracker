<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_nombre = $_POST['usuario_nombre'] ?? '';
    $usuario_email = $_POST['usuario_email'] ?? '';
    $usuario_password = $_POST['usuario_password'] ?? '';
    $usuario_estado = 1;

    if (!$usuario_nombre || !$usuario_email || !$usuario_password) {
        die("⚠️ Faltan datos obligatorios.");
    }

    include '../../conexion.php'; // contiene $pdo

    try {
        // 1️⃣ Verificar si el correo ya existe
        $check = $pdo->prepare("SELECT usuario_id FROM usuario WHERE usuario_email = ?");
        $check->execute([$usuario_email]);

        if ($check->fetch()) {
            echo "<script>
                alert('El correo ya está registrado.');
                window.location.href='/Html/Login/Registrate.html';
            </script>";
            exit;
        }

        // 2️⃣ Hashear la contraseña antes de insertar
        $usuario_password_hashed = password_hash($usuario_password, PASSWORD_DEFAULT);

        // 3️⃣ Insertar usuario con contraseña segura
        $sql = "INSERT INTO usuario 
                (usuario_nombre, usuario_email, usuario_password, usuario_estado)
                VALUES (?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $usuario_nombre,
            $usuario_email,
            $usuario_password_hashed, // ✅ ahora sí está hasheada
            $usuario_estado
        ]);

        echo "<script>
            alert('Registro exitoso');
            window.location.href='../../../src/view/Index.php';
        </script>";
        exit;

    } catch (PDOException $e) {
        error_log("Registro error: " . $e->getMessage());
        echo "❌ Ocurrió un error al registrar. Intentá nuevamente.";
        exit;
    }
}
?>
<link rel="stylesheet" href="../Css/Components/iniciar-crear-cuenta.css">