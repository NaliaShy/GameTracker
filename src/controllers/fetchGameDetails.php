<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../database/conexion.php';


$pdo = getConexion();
$juegoId = $_GET['id'] ?? null;

if (!$juegoId || !is_numeric($juegoId)) {
    echo json_encode(["error" => "ID de juego no válido"]);
    exit;
}

try {
    // 🔹 1. Obtener detalles del juego
    $sql = "
        SELECT 
            j.juego_id,
            j.juego_nombre,
            j.juego_descripcion,
            (
                SELECT image_url 
                FROM juego_imagen 
                WHERE juego_id = j.juego_id AND is_cover = 1 
                LIMIT 1
            ) AS cover_url
        FROM juego j 
        WHERE j.juego_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$juegoId]);
    $juego = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$juego) {
        echo json_encode(["error" => "Juego no encontrado"]);
        exit;
    }

    // 🔹 2. Comentarios
    $sqlComentarios = "
        SELECT 
            c.comen_descripcion AS texto,
            u.usuario_nombre AS usuario
        FROM comentario c
        JOIN usuario u ON c.usuario_id = u.usuario_id
        WHERE c.juego_id = ?
        ORDER BY c.created_at DESC
    ";

    $stmtC = $pdo->prepare($sqlComentarios);
    $stmtC->execute([$juegoId]);
    $comentarios = $stmtC->fetchAll(PDO::FETCH_ASSOC);

    // 🔹 3. Respuesta en el formato que tu JS necesita
    echo json_encode([
        "id" => $juego['juego_id'],
        "nombre" => $juego['juego_nombre'],
        "descripcion" => $juego['juego_descripcion'],
        "cover_url" => $juego['cover_url'],
        "comentarios" => $comentarios,
        "totalComentarios" => count($comentarios)
    ]);
} catch (Exception $e) {
    echo json_encode(["error" => "Error de servidor"]);
}
