<link rel="stylesheet" href="../Css/root.css">
<link rel="stylesheet" href="../Css/Components/header_sidebar_no_conexion.css">

<!-- Menú lateral -->
<nav>
  <div class="menu-icon" id="menu-icon" onclick="toggleMenu()">&#9776;</div>
  <div class="logo">GameTracker</div>
</nav>

<!-- Fondo oscuro -->
<div class="overlay" id="overlay"></div>

<!-- Menú lateral -->
<div class="sidebar" id="sidebar">
  <ul>
    <li><a href="#" id="title-sidebar">Navegar</a></li>
    <li><a href="#">Descubre juegos</a></li>
    <li><a href="#">Mis juegos</a></li>
  </ul>

  <?php include 'boton-SwiftUI.php'; ?>
</div>




<script src="../Js/Components/sidebar-menu.js"></script>