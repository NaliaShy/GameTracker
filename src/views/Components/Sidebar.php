<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="#" id="navNavegar" onclick="mostrarSeccion('contenidoNavegar')">Navegar</a></li>
        <li><a href="#" id="navDescubre" onclick="mostrarSeccion('contenidoDescubre')">Descubre juegos</a></li>
        
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li><a href="#" id="navMisJuegos" onclick="mostrarSeccion('contenidoMisJuegos')">Mis juegos</a></li>
            
            <?php 
            // Verifica directamente si el rol_id es 2 (Administrador)
            if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 2): 
            ?>
                <li class="admin-link-sidebar">
                    <a href="#" id="navAdmin" onclick="mostrarSeccion('contenidoAdmin')">
                        Herramientas Admin 🛡️
                    </a>
                </li>
            <?php endif; ?>
            <?php endif; ?>
    </ul>
</div>