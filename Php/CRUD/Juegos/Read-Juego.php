<?php
include $_SERVER['DOCUMENT_ROOT'] . '/GameTracker/Php/conexion.php'; 
// Esto crea $pdo (PDO)

try {

    $sql = "SELECT 
                j.juego_id,
                j.juego_nombre,
                j.juego_descripcion,
                g.gen_nombre AS genero,
                p.plataf_nombre AS plataforma
            FROM juego j
            LEFT JOIN genero g ON j.gen_id = g.gen_id
            LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
            ORDER BY j.juego_nombre ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener todos los juegos como array
    $juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p style='color:red;'>Error en la consulta: " . $e->getMessage() . "</p>";
}
?>
