<?php
// Este archivo ya no incluye la conexión, porque searchbar.php la tiene
$plataformas = $conn->query("SELECT plataf_id, plataf_nombre FROM plataforma ORDER BY plataf_nombre");
$generos = $conn->query("SELECT gen_id, gen_nombre FROM genero ORDER BY gen_nombre");
$modojuego = $conn->query("SELECT modjuego_id, modjuego_nombre FROM modojuego ORDER BY modjuego_nombre");
$perspectivas = $conn->query("SELECT persp_id, persp_nombre FROM perspectiva ORDER BY persp_nombre");
?>

<link rel="stylesheet" href="../Css/Components/filter.css">

<div class="filter-container">
  <select name="plataforma" id="plataforma">
    <option value="0">-- Selecciona una plataforma --</option>
    <?php while ($p = $plataformas->fetch_assoc()) { ?>
      <option value="<?= $p['plataf_id'] ?>"><?= htmlspecialchars($p['plataf_nombre']) ?></option>
    <?php } ?>
  </select>

  <select name="genero" id="genero">
    <option value="0">-- Selecciona un género --</option>
    <?php while ($g = $generos->fetch_assoc()) { ?>
      <option value="<?= $g['gen_id'] ?>"><?= htmlspecialchars($g['gen_nombre']) ?></option>
    <?php } ?>
  </select>

  <select name="modjuego" id="modjuego">
    <option value="0">-- Selecciona un modo de juego --</option>
    <?php while ($m = $modojuego->fetch_assoc()) { ?>
      <option value="<?= $m['modjuego_id'] ?>"><?= htmlspecialchars($m['modjuego_nombre']) ?></option>
    <?php } ?>
  </select>

  <select name="persp" id="persp">
    <option value="0">-- Selecciona una perspectiva --</option>
    <?php while ($p = $perspectivas->fetch_assoc()) { ?>
      <option value="<?= $p['persp_id'] ?>"><?= htmlspecialchars($p['persp_nombre']) ?></option>
    <?php } ?>
  </select>

  <button type="button" id="limpiar">Limpiar</button>
  <button type="submit" name="buscar" id="buscar">Buscar</button>

</div>

<script src="../Js/Components/boton-clear-search.js"></script>