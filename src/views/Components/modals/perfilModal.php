<?php if (isset($_SESSION['usuario_id'])): ?>

<div id="perfilModal" class="sidebarPerfil">
    <ul>
        <li><a href="#" id="title-sidebar" onclick="cuenta()">Cuenta</a></li>
        <li><a href="#">Configuración</a></li>
        <li><a href="../../../src/controllers/logoutController.php">Cerrar sesión</a></li>
    </ul>
</div>
<?php endif; 
include __DIR__ . '/avatarSelectionModal.php';
?>
