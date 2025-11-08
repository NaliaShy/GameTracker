<?php session_start(); ?>

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
<link rel="stylesheet" href="../Css/Components/iniciar-crear-cuenta.css">
<!-- Botón que abre el modal -->
<div class="iniciar-seccion-crear-cuenta">
    <?php if (isset($_SESSION['usuario_id'])): ?>

        <!-- ✅ Usuario LOGEADO -->
        <a href="#">Perfil</a>

    <?php else: ?>

        <!-- ✅ Usuario NO logeado -->
        <a href="#" id="btnAbrirIniciarSeccion" >Iniciar sesión</a>
        <a href="#" id="btnAbrirCrearCuenta">Crear cuenta</a>

    <?php endif; ?>
</div>

<!-- Modal completo -->
 <div id="modal-iniciar-seccion" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="cerrarIniciar">&times;</span>
      <form action="../../Php/CRUD/Usuario/login.php" method="post">
        <h2>Iniciar sesión</h2>
        <label for="usuario_email">Correo electrónico:</label>
        <input type="email" id="usuario_email" name="usuario_email" required>

        <label for="usuario_password">Contraseña:</label>
        <input type="password" id="usuario_password" name="usuario_password" required>

        <button type="submit">Iniciar sesión</button>
        <p class="forgot-password"><a href="#">¿Olvidaste tu contraseña?</a></p>
      </form>
    </div>
</div>

 <div id="modal-crear-cuenta" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="cerrarCrear">&times;</span>
     <form action="../../Php/CRUD/Usuario/Create-usuario.php" method="post">
        <h2>Crear cuenta</h2>
        <label for="usuario_nombre">Nombre de usuario:</label>
        <input type="text" id="usuario_nombre" name="usuario_nombre" required>

        <label for="usuario_email">Correo electrónico:</label>
        <input type="email" id="usuario_email" name="usuario_email" required>

        <label for="usuario_password">Contraseña:</label>
        <input type="password" id="usuario_password" name="usuario_password" required>

        <button type="submit">Crear cuenta</button>
     </form>
    </div>
</div>
<script src="../Js/Components/ventanaemergenete.js"></script>
<script src="../Js/Components/sidebar-menu.js"></script>