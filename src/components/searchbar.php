<?php
include '../../Php/conexion.php';

$termino = isset($_GET['q']) ? trim($_GET['q']) : '';
$genero = isset($_GET['genero']) ? (int)$_GET['genero'] : 0;
$plataforma = isset($_GET['plataforma']) ? (int)$_GET['plataforma'] : 0;

$sql = "SELECT j.juego_id, j.juego_nombre, j.juego_descripcion, 
               g.gen_nombre, p.plataf_nombre
        FROM juego j
        LEFT JOIN genero g ON j.gen_id = g.gen_id
        LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
        WHERE 1=1";

if ($termino !== '') {
  $sql .= " AND j.juego_nombre LIKE '%" . $conn->real_escape_string($termino) . "%'";
}
if ($genero > 0) {
  $sql .= " AND j.gen_id = $genero";
}
if ($plataforma > 0) {
  $sql .= " AND j.plataf_id = $plataforma";
}

$sql .= " ORDER BY j.juego_nombre ASC";

$result = $conn->query($sql);

$juegos = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $juegos[] = $row;
  }
}
$conn->close();
?>



<link rel="stylesheet" href="../Css/Components/searchbar.css">
<div class="search-container">
  <div class="search-box">
    <input type="text" id="buscar" placeholder="Buscar juego..." />
  </div>

  <div id="resultados"></div>

</div>

<script src="../Js/Components/searchbar.js"></script>