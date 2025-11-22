<?php
// No es necesario iniciar la sesión aquí, ya que el registro no inicia sesión inmediatamente.
// session_start(); 
require_once __DIR__ . '/../database/conexion.php'; // Asegúrate que esta ruta es correcta

$pdo = getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Obtener y sanear los datos del formulario de registro
    $nombre = trim($_POST['nombre'] ?? ''); 
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validaciones básicas (puedes añadir más, como longitud de nombre/contraseña)
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo electrónico no es válido.";
        exit;
    }

    // 2. Verificar si el correo ya existe
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE usuario_email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            echo "Este correo electrónico ya está registrado.";
            exit;
        }
    } catch (PDOException $e) {
        // Error al consultar la base de datos
        error_log("Error al verificar email: " . $e->getMessage());
        echo "Error en el servidor al verificar el correo.";
        exit;
    }


    // 3. Hashear la contraseña (¡CRUCIAL!)
    // PASSWORD_DEFAULT utiliza el algoritmo más seguro y actualizado.
    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 
    
    // 4. Insertar el nuevo usuario
    try {
        $sql = "INSERT INTO usuario (usuario_nombre, usuario_email, usuario_password) 
                VALUES (:nombre, :email, :password)";
                
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash); // Usamos la contraseña hasheada
        
        $stmt->execute();
        
        // 5. Éxito
        echo "OK";
        
    } catch (PDOException $e) {
        // Error de inserción
        // Para debug, puedes mostrar el error. En producción, es mejor un mensaje genérico.
        // echo "Error: " . $e->getMessage(); 
        error_log("Error al insertar usuario: " . $e->getMessage());
        echo "Error al crear la cuenta. Inténtalo de nuevo.";
    }
    
    exit(); 
} else {
    // Si se accede a este archivo sin ser por POST
    http_response_code(405); // Método no permitido
    echo "Método no permitido.";
}
?>