<?php
// MisJuegosTemplate.php: Usa las variables $juegos, $error y $genero_favorito.
?>

<div id="misJuegosContent">

    <?php if ($error): ?>
        <p><?= htmlspecialchars($error) ?></p>

    <?php else: ?>
        <div class="mis-juegos-layout">

            <div class="mis-juegos-stats-col">
                <h2>🏆 Mis Estadísticas</h2>
                <hr>
                <div class="stat-card">
                    <h3>Tu Género Favorito</h3>
                    
                    <p class="stat-value"><?= htmlspecialchars($genero_favorito ?? 'N/A') ?></p>
                </div>

            </div>

            <div class="mis-juegos-list-col">
                <h2>🎮 Mis Juegos Calificados (<?= count($juegos) ?>)</h2>
                <hr>
                <div class="mis-juegos-container">
                    <?php foreach ($juegos as $juego):
                        $cover = htmlspecialchars($juego['cover_url'] ?? '../../img/sin_portada.png');
                        $nombre = htmlspecialchars($juego['juego_nombre']);
                        $desc = htmlspecialchars($juego['juego_descripcion']);
                        $id = (int)$juego['juego_id'];
                        $rating = (int)$juego['usuario_rating'];
                        $estrellas = str_repeat("★", $rating) . str_repeat("☆", 5 - $rating);
                    ?>
                        <div class="juego-card" data-juego-id="<?= $id ?>">
                            <div class="juego-content">
                                <img src="<?= $cover ?>" alt="Portada <?= $nombre ?>" class="juego-cover">
                                <h3><?= $nombre ?></h3>
                                <p class="user-rating-display">
                                    Mi Rating: <span class="stars" title="<?= $rating ?>/5"><?= $estrellas ?></span>
                                </p>
                                <p><?= $desc ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    <?php endif; ?>

</div>