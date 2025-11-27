<?php
include __DIR__ . '/../../../controllers/admin.php';
require_once __DIR__ . '/../../../controllers/juegoController.php';
$juegos = obtenerTodosLosJuegos();
$mensaje = "";
if (empty($juegos)) {
    $mensaje = "No hay juegos registrados en la base de datos.";
}
?>
<div class="admin-header">
    <div>
        <h1>Panel de Administración</h1>
    </div>
    <p>Bienvenido, <?php echo $nombre_admin; ?> (ID de Rol: <?php echo $_SESSION['rol_id']; ?>)</p>
</div>

<div class="dashboard-layout">

    <seccion class="admin-nav-sidebar">
        <ul>
            <li><a href="#" onclick="mostrarModulo('gestionUsuarios', this)">Gestión de Usuarios</a></li>
            <li><a href="#" onclick="mostrarModulo('gestionJuegos', this)">Gestión de Juegos</a></li>
            <li><a href="#" onclick="mostrarModulo('reportesLogs', this)">Reportes y Logs</a></li>
        </ul>
    </seccion>

    <div class="admin-content-area">

        <div id="gestionUsuarios" class="admin-module-content">
            <h2>Gestión de Usuarios</h2>
            <p>Aquí irá la tabla y las herramientas para modificar usuarios.</p>
        </div>

        <div id="gestionJuegos" class="admin-module-content">
            <?php include __DIR__ . '/modulos/datos_juegos.php'; ?>
        </div>

        <div id="reportesLogs" class="admin-module-content">
            <h2>Reportes y Logs</h2>
            <p>Visualización de errores del servidor y reportes de usuarios.</p>
        </div>

    </div>
</div>