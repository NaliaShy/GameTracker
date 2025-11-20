
<div id="loginModal" class="modal">
    <div class="modal-content">
        <div class="modal-close-tittle">
            <span class="close" id="cerrarLogin">&times;</span>
            <h2>Iniciar sesión</h2>
        </div>
        <form id="loginForm" method="POST">
            <label>Correo</label>
            <input type="email" name="email" required>
            <label>Contraseña</label>
            <input type="password" name="password" required>
            <button type="submit">Entrar</button>
            <div id="loginMsg" class="modal-message"></div>
        </form>
        
    </div>
</div>
