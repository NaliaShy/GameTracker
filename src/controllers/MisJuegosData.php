<?php
// MisJuegosData.php: Obtiene lista de juegos y calcula el género favorito.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../database/Conexion.php';
$pdo = getConexion();

$usuario_id = $_SESSION['usuario_id'] ?? null;
$juegos = [];
$genero_favorito = "Aún no has calificado suficientes juegos."; // Nueva variable de estadística
$error = null;

if (!$usuario_id) {
    $error = "Debes iniciar sesión para ver tus juegos.";
} else {
    try {
        // 1. OBTENER LISTA DE JUEGOS CALIFICADOS CON SU RATING
        $stmt_juegos = $pdo->prepare("
            SELECT 
                j.juego_id, j.juego_nombre, j.juego_descripcion, 
                ji.image_url AS cover_url, ur.rating AS usuario_rating
            FROM juego j
            INNER JOIN user_juego_rating ur ON ur.juego_id = j.juego_id
            LEFT JOIN juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
            WHERE ur.usuario_id = :usuario_id
            ORDER BY j.juego_nombre ASC
        ");
        $stmt_juegos->execute([':usuario_id' => $usuario_id]);
        $juegos = $stmt_juegos->fetchAll(PDO::FETCH_ASSOC);

        // 2. OBTENER EL GÉNERO FAVORITO (el más calificado)
        $stmt_genero = $pdo->prepare("
            SELECT
    j.juego_id,
    j.juego_nombre,
    j.juego_descripcion,
    ji.image_url AS cover_url,  -- URL de la imagen (de la tabla juego_imagen ji)
    ur.rating AS usuario_rating  -- Rating del usuario (de la tabla user_juego_rating ur)
FROM 
    juego j
INNER JOIN 
    user_juego_rating ur ON ur.juego_id = j.juego_id
LEFT JOIN 
    juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
WHERE 
    ur.usuario_id = :usuario_id
ORDER BY 
    j.juego_nombre ASC
        ");
        // ...
        $stmt_genero->execute([':usuario_id' => $usuario_id]);
        $favorito_data = $stmt_genero->fetch(PDO::FETCH_ASSOC);

        // Verifica que el fetch fue exitoso (no es false) Y que la clave exista
        if (is_array($favorito_data) && isset($favorito_data['genero_nombre'])) {
            $genero_favorito = $favorito_data['genero_nombre'];
        }
        // Si no hay datos (es false o la clave no está), $genero_favorito mantiene su valor inicial:
        // $genero_favorito = "Aún no has calificado suficientes juegos."; 
        // ...  
        // Código Anterior
        // if ($favorito_data) {
        //     $genero_favorito = $favorito_data['genero_nombre'];
        // }

        // Código Corregido (Línea 57 o cerca)
        if ($favorito_data && isset($favorito_data['genero_nombre'])) {
            $genero_favorito = $favorito_data['genero_nombre'];
        }

        if (!$juegos) {
            $error = "No tienes juegos calificados aún.";
        }
    } catch (PDOException $e) {
        error_log("Error de DB al cargar mis juegos/stats: " . $e->getMessage());
        $error = "Error al cargar la información desde la base de datos.";
    }
}
// El script termina. $juegos, $genero_favorito, o $error están listos.
