<?php
// filter.php recibe PDO desde searchbar.php

if (!isset($pdo_filters)) {
    die("ERROR: PDO no llegó a filter.php");
}

$pdo = $pdo_filters;


// Obtener géneros
$stmt = $pdo->query("SELECT gen_id, gen_nombre FROM genero ORDER BY gen_nombre ASC");
$generos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener plataformas
$stmt = $pdo->query("SELECT plataf_id, plataf_nombre FROM plataforma ORDER BY plataf_nombre ASC");
$plataformas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener modos de juego
$stmt = $pdo->query("SELECT modjuego_id, modjuego_nombre FROM modojuego ORDER BY modjuego_nombre ASC");
$modos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener perspectiva
$stmt = $pdo->query("SELECT persp_id, persp_nombre FROM perspectiva ORDER BY persp_nombre ASC");
$perspectivas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="filters">
  <select name="genero">
    <option value="0">Género</option>
    <?php foreach ($generos as $g): ?>
      <option value="<?= $g['gen_id'] ?>"><?= htmlspecialchars($g['gen_nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <select name="plataforma">
    <option value="0">Plataforma</option>
    <?php foreach ($plataformas as $p): ?>
      <option value="<?= $p['plataf_id'] ?>"><?= htmlspecialchars($p['plataf_nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <select name="modjuego">
    <option value="0">Modo de juego</option>
    <?php foreach ($modos as $m): ?>
      <option value="<?= $m['modjuego_id'] ?>"><?= htmlspecialchars($m['modjuego_nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <select name="persp">
    <option value="0">Perspectiva</option>
    <?php foreach ($perspectivas as $ps): ?>
      <option value="<?= $ps['persp_id'] ?>"><?= htmlspecialchars($ps['persp_nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit" name="buscar">Buscar</button>
</div>