<?php include '../../Php/CRUD/Juegos/read-Juego.php'; ?>
<link rel="stylesheet" href="../Css/Components/show-games.css">

<div class="juegos-container">

    <?php if (!empty($juegos)): ?>
        <div class="juegos-grid">
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
        </div>
    <?php else: ?>
        <p>No hay juegos registrados todavía 😢</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>