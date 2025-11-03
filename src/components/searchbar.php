<?php
include '../../Php/conexion.php';

// Detectar si se presionó el botón "Buscar"
$buscarPresionado = isset($_GET['buscar']);

$termino = isset($_GET['q']) ? trim($_GET['q']) : '';
$genero = isset($_GET['genero']) ? (int)$_GET['genero'] : 0;
$plataforma = isset($_GET['plataforma']) ? (int)$_GET['plataforma'] : 0;
$modjuego = isset($_GET['modjuego']) ? (int)$_GET['modjuego'] : 0;
$persp = isset($_GET['persp']) ? (int)$_GET['persp'] : 0;

$juegos = [];

if ($buscarPresionado) {
  $sql = "SELECT 
            j.juego_id,
            j.juego_nombre,
            j.juego_descripcion,
            g.gen_nombre AS genero,
            p.plataf_nombre AS plataforma
          FROM juego j
          LEFT JOIN genero g ON j.gen_id = g.gen_id
          LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
          WHERE 1=1";

  if ($termino !== '') $sql .= " AND j.juego_nombre LIKE '%" . $conn->real_escape_string($termino) . "%'";
  if ($genero > 0) $sql .= " AND j.gen_id = $genero";
  if ($plataforma > 0) $sql .= " AND j.plataf_id = $plataforma";
  if ($modjuego > 0) $sql .= " AND j.modjuego_id = $modjuego";
  if ($persp > 0) $sql .= " AND j.persp_id = $persp";

  $sql .= " ORDER BY j.juego_nombre ASC";

  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) $juegos[] = $row;
  }
}

?>

<link rel="stylesheet" href="../Css/Components/searchbar.css">

<div class="searchbar">
  <form method="get" class="search-container">
    <div class="search-box">
      <input
        type="text"
        name="q"
        placeholder="Buscar juego..."
        value="<?= htmlspecialchars($termino) ?>" />
    </div>

    <!-- ✅ Ahora el filtro no reincluye la conexión -->
    <?php include '../components/filter.php'; ?>

  </form>

  <div id="resultados" class="resultados-container">
    <?php if ($buscarPresionado): ?>
      <?php if (!empty($juegos)): ?>
        <?php foreach ($juegos as $juego): ?>
          <a href="../../Php/CRUD/juegos/ver-juego.php?id=<?= urlencode($juego['juego_id']) ?>" class="juego-link">
            <div class="juego-card">
              <h3><?= htmlspecialchars($juego['juego_nombre']) ?></h3>
              <p><?= htmlspecialchars($juego['juego_descripcion']) ?></p>
              <small>
                🏷️ <?= htmlspecialchars($juego['genero'] ?? 'Sin género') ?><br>
                💻 <?= htmlspecialchars($juego['plataforma'] ?? 'Sin plataforma') ?>
              </small>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No se encontraron resultados.</p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>


<?php $conn->close(); // ✅ Cerramos la conexión aquí, al final ?>
