<?php
// Evita que notices/warnings rompan JSON
ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

header('Content-Type: application/json');

session_start();

require_once __DIR__ . '/../database/Conexion.php';
$pdo = getConexion();

try {
    // Lee input JSON
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (!$data || !isset($data['juego_id']) || !isset($data['rating'])) {
        echo json_encode([
            "success" => false,
            "error" => "Datos incompletos",
            "recibido" => $data ?? null
        ]);
        exit;
    }

    $usuario_id = $_SESSION['usuario_id'] ?? null;
    if (!$usuario_id) {
        echo json_encode([
            "success" => false,
            "error" => "Usuario no autenticado"
        ]);
        exit;
    }

    $juego_id = intval($data['juego_id']);
    $rating = intval($data['rating']);

    $conn = getConexion(); // tu función de conexión
    $stmt = $conn->prepare("
        INSERT INTO user_juego_rating (usuario_id, juego_id, rating)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE rating = VALUES(rating)
    ");
    $stmt->execute([$usuario_id, $juego_id, $rating]);

    echo json_encode([
        "success" => true,
        "message" => "Rating guardado",
        "rating" => $rating
    ]);
    exit;

} catch (Exception $e) {
    // Nunca imprime errores al navegador
    error_log("SetRating Error: " . $e->getMessage());
    echo json_encode([
        "success" => false,
        "error" => "Error interno del servidor"
    ]);
    exit;
}
?>
