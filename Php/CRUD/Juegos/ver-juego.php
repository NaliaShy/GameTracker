<?php
include '../../conexion.php';

// Verificamos si hay ID
$juego_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($juego_id <= 0) {
  echo "<p>ID inválido o juego no especificado.</p>";
  exit;
}

// Consulta para obtener el juego
$sql = "SELECT 
          j.juego_id,
          j.juego_nombre,
          j.juego_descripcion,
          g.gen_nombre AS genero,
          p.plataf_nombre AS plataforma
        FROM juego j
        LEFT JOIN genero g ON j.gen_id = g.gen_id
        LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
        WHERE j.juego_id = $juego_id";

$result = $conn->query($sql);
$juego = $result->fetch_assoc();

$conn->close();
?>

<link rel="stylesheet" href="../Css/Components/ver-juego.css">

<div class="juego-detalle-container">
  <?php if ($juego): ?>
    <h2><?= htmlspecialchars($juego['juego_nombre']) ?></h2>
    <p><?= nl2br(htmlspecialchars($juego['juego_descripcion'])) ?></p>

    <div class="juego-info">
      <p>🏷️ Género: <strong><?= htmlspecialchars($juego['genero'] ?? 'Sin género') ?></strong></p>
      <p>💻 Plataforma: <strong><?= htmlspecialchars($juego['plataforma'] ?? 'Sin plataforma') ?></strong></p>
    </div>

    <a href="../../../src/View/Index.php" class="volver-btn">⬅ Volver a la lista</a>
  <?php else: ?>
    <p>Juego no encontrado 😢</p>
  <?php endif; ?>
</div>
