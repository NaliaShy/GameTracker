<?php
include '../../Php/conexion.php';

// Consulta de plataformas
$plataformas = $conn->query("SELECT plataf_id, plataf_nombre FROM plataforma ORDER BY plataf_nombre");

// Consulta de géneros
$generos = $conn->query("SELECT gen_id, gen_nombre FROM genero ORDER BY gen_nombre");
?>

<link rel="stylesheet" href="../Css/Components/filter.css">

<div class="filter-container">
  <!-- Select de plataformas -->
  <select name="plataforma" id="plataforma">
    <option value="">-- Selecciona una plataforma --</option>
    <?php while ($p = $plataformas->fetch_assoc()) { ?>
      <option value="<?= $p['plataf_id'] ?>"><?= htmlspecialchars($p['plataf_nombre']) ?></option>
    <?php } ?>
  </select>

  <!-- Select de géneros -->
  <select name="genero" id="genero">
    <option value="">-- Selecciona un género --</option>
    <?php while ($g = $generos->fetch_assoc()) { ?>
      <option value="<?= $g['gen_id'] ?>"><?= htmlspecialchars($g['gen_nombre']) ?></option>
    <?php } ?>
  </select>

  <button id="clearFilters">Limpiar</button>

</div>

<script src="../Js/components/filter.js"></script>