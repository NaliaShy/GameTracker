<?php
require_once realpath(__DIR__ . '/../../database/conexion.php');
$pdo = getConexion(); // ← AQUÍ ES DONDE CREAS $pdo


if (!isset($pdo)) {
    die("SearchBar: pdo NO existe ❌");
}

// Detectar si se presionó "Buscar"
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
        p.plataf_nombre AS plataforma,
        ji.image_url AS cover_url
    FROM juego j
    LEFT JOIN genero g ON j.gen_id = g.gen_id
    LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
    LEFT JOIN juego_imagen ji ON ji.juego_id = j.juego_id AND ji.is_cover = 1
    WHERE 1=1
    ";

    $params = [];

    if ($termino !== '') {
        $sql .= " AND j.juego_nombre LIKE :termino";
        $params[':termino'] = "%$termino%";
    }

    if ($genero > 0) {
        $sql .= " AND j.gen_id = :genero";
        $params[':genero'] = $genero;
    }

    if ($plataforma > 0) {
        $sql .= " AND j.plataf_id = :plataforma";
        $params[':plataforma'] = $plataforma;
    }

    if ($modjuego > 0) {
        $sql .= " AND j.modjuego_id = :modjuego";
        $params[':modjuego'] = $modjuego;
    }

    if ($persp > 0) {
        $sql .= " AND j.persp_id = :persp";
        $params[':persp'] = $persp;
    }

    $sql .= " ORDER BY j.juego_nombre ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- SEARCH BAR COMPONENTE -->

<div class="searchbar">
    <form method="get" class="search-container">
        <div class="search-box">
            <input
                type="text"
                name="q"
                placeholder="Buscar juego..."
                value="<?= htmlspecialchars($termino) ?>" />
        </div>
        <div class="filter-container">
            <?php
            $pdo_filters = $pdo;
            include __DIR__ . '/filter.php';
            ?>
        </div>
    </form>
</div>

<div id="resultados" class="resultados-container">
    <?php if ($buscarPresionado): ?>
        <?php if (!empty($juegos)): ?>
            <?php foreach ($juegos as $juego): ?>
                
                <a href="#" class="juego-card" data-juego-id="<?= $juego['juego_id'] ?>">
                    <div class="juego-content"> 
                        <?php if (!empty($juego['cover_url'])): ?>
                            <img src="<?= htmlspecialchars($juego['cover_url']) ?>" 
                                alt="Portada de <?= htmlspecialchars($juego['juego_nombre']) ?>" 
                                class="juego-cover">
                        <?php else: ?>
                            <img src="../../img/sin_portada.png" 
                                alt="Sin portada" 
                                class="juego-cover">
                        <?php endif; ?>

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