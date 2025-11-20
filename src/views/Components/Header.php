<?php
if (session_status() === PHP_SESSION_ACTIVE) {
} else {
    session_start();
}
?>

<nav>
    <div class="nav-left">
        <div class="menu-icon" id="menu-icon" onclick="toggleMenu()">&#9776;</div>
    </div>

    <div class="nav-center">
        <div class="logo">GameTracker</div>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="#" id="btnAbrirPerfil" onclick="openPerfil()">Perfil</a>
        <?php else: ?>
            <a href="#" id="btnAbrirIniciarSeccion" onclick="openSeccion()">Iniciar sesión</a>
            <a href="#" id="btnAbrirCrearCuenta" onclick= "openCuenta()">Crear cuenta</a>
        <?php endif; ?>
    </div>


</nav>



<!-- Incluí los modales -->
<?php include __DIR__ . '/Modals/loginModal.php'; ?>
<?php include __DIR__ . '/Modals/registerModal.php'; ?>
<?php include __DIR__ . '/Modals/perfilModal.php'; ?>