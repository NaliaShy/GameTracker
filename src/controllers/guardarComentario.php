<?php
header('Content-Type: application/json');
session_start();

$userId = $_SESSION['usuario_id'] ?? null;
$juegoId = $_POST['juego_id'] ?? null;
$comentario = $_POST['comentario_texto'] ?? null;

if (!$userId || !$juegoId || !$comentario) {
    echo json_encode(["success" => false, "error" => "Datos incompletos."]);
    exit;
}


require_once __DIR__ . '/../database/conexion.php';

$pdo = getConexion();

$sql = "INSERT INTO comentario (juego_id, usuario_id, comen_descripcion) 
        VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);

if ($stmt->execute([$juegoId, $userId, $comentario])) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Error al insertar."]);
}
exit;