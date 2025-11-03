<?php
include '../../Php/conexion.php';

$sql = "SELECT 
          j.juego_id,
          j.juego_nombre,
          j.juego_descripcion,
          g.gen_nombre AS genero,
          p.plataf_nombre AS plataforma
        FROM juego j
        LEFT JOIN genero g ON j.gen_id = g.gen_id
        LEFT JOIN plataforma p ON j.plataf_id = p.plataf_id
        ORDER BY j.juego_nombre ASC";

$result = $conn->query($sql);

$juegos = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $juegos[] = $row;
  }
}
?>
