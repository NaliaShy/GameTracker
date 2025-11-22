<?php
if (session_status() === PHP_SESSION_ACTIVE) {
} else {
    session_start();
}

// 1. Definir la ruta del avatar. Si no está en sesión, usar el default.
$avatar_path = '/GameTracker/public/img/avatars/default.png'; 
$user_name = ''; // Inicializar variable para el nombre

if (isset($_SESSION['usuario_id'])) {
    if (isset($_SESSION['usuario_avatar'])) {
        $avatar_path = $_SESSION['usuario_avatar'];
    }
    // 2. Obtener el nombre de usuario de la sesión
    $user_name = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : 'Perfil'; 
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
            
            <a href="#" id="btnAbrirPerfil" onclick="openPerfil()" class="avatar-link">
                <img src="<?php echo htmlspecialchars($avatar_path); ?>" 
                     alt="Avatar de perfil" 
                     class="profile-avatar-nav" 
                     id="mainProfileAvatar">
                     
                <span class="profile-username-nav">
                    <?php echo htmlspecialchars($user_name); ?>
                </span>
            </a>
            
        <?php else: ?>
            <a href="#" id="btnAbrirIniciarSeccion" onclick="openSeccion()">Iniciar sesión</a>
            <a href="#" id="btnAbrirCrearCuenta" onclick= "openCuenta()">Crear cuenta</a>
        <?php endif; ?>
    </div>
</nav>

<?php include __DIR__ . '/Modals/loginModal.php'; ?>
<?php include __DIR__ . '/Modals/registerModal.php'; ?>
<?php include __DIR__ . '/Modals/perfilModal.php'; ?>