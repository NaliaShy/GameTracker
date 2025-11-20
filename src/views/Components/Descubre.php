<?php
// ==============================
// CONEXIÓN A LA BASE DE DATOS
// ==============================
require_once realpath(__DIR__ . '/../../database/conexion.php');
$pdo = getConexion();

if (!$pdo) {
  die("❌ Error: No se pudo conectar a la base de datos.");
}

// ... (Todas las consultas PHP permanecen IGUALES) ...

$sqlPopulares = "
  SELECT 
  j.juego_id,
  j.juego_nombre,
  j.juego_descripcion,
  COUNT(c.comen_id) AS total_comentarios,
  (
    SELECT ji.image_url 
    FROM juego_imagen ji 
    WHERE ji.juego_id = j.juego_id 
     AND ji.is_cover = 1
    LIMIT 1
  ) AS cover_url
FROM juego j
LEFT JOIN comentario c ON j.juego_id = c.juego_id
GROUP BY j.juego_id
ORDER BY total_comentarios DESC
LIMIT 6;

";
$popStmt = $pdo->prepare($sqlPopulares);
$popStmt->execute();
$populares = $popStmt->fetchAll(PDO::FETCH_ASSOC);

$sqlNuevos = "
  SELECT j.juego_id, j.juego_nombre, j.juego_descripcion, j.juego_fecha_lanzamiento,
     ji.image_url AS cover_url
  FROM juego j
  LEFT JOIN juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
  ORDER BY j.juego_fecha_lanzamiento DESC
  LIMIT 6;
";
$newStmt = $pdo->prepare($sqlNuevos);
$newStmt->execute();
$nuevos = $newStmt->fetchAll(PDO::FETCH_ASSOC);

$sqlAventura = "
  SELECT j.juego_id, j.juego_nombre, j.juego_descripcion,
     ji.image_url AS cover_url
  FROM juego j
  LEFT JOIN juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
  WHERE j.gen_id = 2
  LIMIT 6;
";
$aventStmt = $pdo->prepare($sqlAventura);
$aventStmt->execute();
$aventura = $aventStmt->fetchAll(PDO::FETCH_ASSOC);

$sqlRandom = "
  SELECT j.juego_id, j.juego_nombre, j.juego_descripcion,
     ji.image_url AS cover_url
  FROM juego j
  LEFT JOIN juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
  ORDER BY RAND()
  LIMIT 6;
";
$randStmt = $pdo->prepare($sqlRandom);
$randStmt->execute();
$recomendados = $randStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="descubre-container">
  <h2 class="section-title">🔥 Juegos Más Populares</h2>
  <div class="grid-juegos">
    <?php foreach ($populares as $j): ?>
      <a href="#" class="juego-card" data-juego-id="<?= $j['juego_id'] ?>">
        <div class="juego-img">
          <?php if (!empty($j['cover_url'])): ?>
            <img src="<?= htmlspecialchars($j['cover_url']) ?>" alt="<?= htmlspecialchars($j['juego_nombre']) ?> portada">
          <?php endif; ?>
        </div>
        <div class="juego-descripcion">
          <h3><?= htmlspecialchars($j['juego_nombre']) ?></h3>
          <small>💬 <?= $j['total_comentarios'] ?> comentarios</small>
          <p><?= htmlspecialchars($j['juego_descripcion']) ?></p>
        </div>
      </a> <?php endforeach; ?>
  </div>
  <h2 class="section-title">🆕 Recién Añadidos</h2>
  <div class="grid-juegos">
    <?php foreach ($nuevos as $j): ?>
      <a href="#" class="juego-card" data-juego-id="<?= $j['juego_id'] ?>">
        <div class="juego-img"> <?php if (!empty($j['cover_url'])): ?>
            <img src="<?= htmlspecialchars($j['cover_url']) ?>" alt="<?= htmlspecialchars($j['juego_nombre']) ?> portada">
          <?php endif; ?>
        </div>
        <div class="juego-descripcion">
          <h3><?= htmlspecialchars($j['juego_nombre']) ?></h3>
          <small>📅 <?= $j['juego_fecha_lanzamiento'] ?></small>
          <p><?= htmlspecialchars($j['juego_descripcion']) ?></p>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <h2 class="section-title">🧭 Género: Aventura</h2>
  <div class="grid-juegos">
    <?php foreach ($aventura as $j): ?>
      <a href="#" class="juego-card" data-juego-id="<?= $j['juego_id'] ?>">
        <div class="juego-img">
          <?php if (!empty($j['cover_url'])): ?>
            <img src="<?= htmlspecialchars($j['cover_url']) ?>" alt="<?= htmlspecialchars($j['juego_nombre']) ?> portada">
          <?php endif; ?>
        </div>
        <div class="juego-descripcion">
          <h3><?= htmlspecialchars($j['juego_nombre']) ?></h3>
          <p><?= htmlspecialchars($j['juego_descripcion']) ?></p>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <h2 class="section-title">🎲 Recomendados Para Ti</h2>
  <div class="grid-juegos">
    <?php foreach ($recomendados as $j): ?>
      <a href="#" class="juego-card" data-juego-id="<?= $j['juego_id'] ?>">
        <div class="juego-img">
          <?php if (!empty($j['cover_url'])): ?>
            <img src="<?= htmlspecialchars($j['cover_url']) ?>" alt="<?= htmlspecialchars($j['juego_nombre']) ?> portada">
          <?php endif; ?>
        </div>
        <div class="juego-descripcion">
          <h3><?= htmlspecialchars($j['juego_nombre']) ?></h3>
          <p><?= htmlspecialchars($j['juego_descripcion']) ?></p>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

</div> 