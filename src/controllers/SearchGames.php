<?php
header('Content-Type: application/json');
session_start();

require_once __DIR__ . '/../database/conexion.php'; 
$pdo = getConexion();
error_log("Usuario ID en sesión: " . $usuario_id);

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

/* ============================
   TOTAL DE JUEGOS
   ============================ */
$stmt = $pdo->prepare("
    SELECT COUNT(cj.juego_id)
    FROM coleccion c
    JOIN coleccion_juego cj ON c.coleccion_id = cj.coleccion_id
    WHERE c.usuario_id = ?
");
$stmt->execute([$usuario_id]);
$total_juegos = $stmt->fetchColumn();

/* ============================
   TOTAL DE COMENTARIOS
   ============================ */
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM comentario 
    WHERE usuario_id = ?
");
$stmt->execute([$usuario_id]);
$total_comentarios = $stmt->fetchColumn();

/* ============================
   GÉNEROS
   ============================ */
$stmt = $pdo->prepare("
    SELECT g.gen_nombre, COUNT(j.juego_id) AS total
    FROM coleccion c
    JOIN coleccion_juego cj ON c.coleccion_id = cj.coleccion_id
    JOIN juego j ON cj.juego_id = j.juego_id
    JOIN genero g ON j.gen_id = g.gen_id
    WHERE c.usuario_id = ?
    GROUP BY g.gen_id
");
$stmt->execute([$usuario_id]);
$generos = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ============================
   PLATAFORMAS
   ============================ */
$stmt = $pdo->prepare("
    SELECT p.plataf_nombre, COUNT(j.juego_id) AS total
    FROM coleccion c
    JOIN coleccion_juego cj ON c.coleccion_id = cj.coleccion_id
    JOIN juego j ON cj.juego_id = j.juego_id
    JOIN plataforma p ON j.plataf_id = p.plataf_id
    WHERE c.usuario_id = ?
    GROUP BY p.plataf_id
");
$stmt->execute([$usuario_id]);
$plataformas = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ============================
   JUEGOS RECIENTES
   ============================ */
$stmt = $pdo->prepare("
    SELECT j.juego_nombre, j.juego_fecha_lanzamiento
    FROM coleccion c
    JOIN coleccion_juego cj ON c.coleccion_id = cj.coleccion_id
    JOIN juego j ON cj.juego_id = j.juego_id
    WHERE c.usuario_id = ?
    ORDER BY j.juego_fecha_lanzamiento DESC
    LIMIT 5
");
$stmt->execute([$usuario_id]);
$juegos_recientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ============================
   RESPUESTA FINAL
   ============================ */

echo json_encode([
    'total_juegos' => $total_juegos,
    'total_comentarios' => $total_comentarios,
    'generos' => $generos,
    'plataformas' => $plataformas,
    'juegos_recientes' => $juegos_recientes
]);
exit;
