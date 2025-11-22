function openSeccion() {
    const Login = document.getElementById("loginModal");
    const overlay = document.getElementById("overlay");
    Login.classList.add("active");
    overlay.classList.add("active");
}

function openCuenta() {
    const Cuenta = document.getElementById("registerModal");
    const overlay = document.getElementById("overlay");
    Cuenta.classList.add("active");
    overlay.classList.add("active");
}

function cuenta() {
    // Usamos el ID del contenedor que tiene la clase "modal"
    const avatarModal = document.getElementById("avatarSelectionModalWrapper");
    const overlay = document.getElementById("overlay");

    if (avatarModal) {
        avatarModal.classList.add("active");
        overlay.classList.add("active");
    } else {
        console.error("Error: #avatarSelectionModalWrapper no encontrado.");
    }
}
function openPerfil() {
    const Perfil = document.getElementById("perfilModal");
    const overlay = document.getElementById("overlay");

    if (Perfil) {
        Perfil.classList.add("active");
        overlay.classList.add("active");
    }
}
// Usamos la función de ayuda para cerrar
function cerrarElemento(el) {
    if (el) {
        el.classList.remove("active");
    }
}

// Función de ayuda para remover la clase 'active'
function cerrarElemento(el) {
    if (el) {
        el.classList.remove("active");
    }
}

// Función centralizada que contiene la lógica de cierre global
function cerrarModalesGlobalmente() {
    // Referencias de modales (las buscamos dentro de la función)
    const overlay = document.getElementById('overlay');
    const Login = document.getElementById('loginModal');
    const Register = document.getElementById('registerModal');
    const Perfil = document.getElementById('perfilModal');
    
    // El modal de avatares (importante si se carga dinámicamente)
    const AvatarModal = document.getElementById("avatarSelectionModalWrapper"); 

    // Cierra todos los modales (incluyendo el de avatares)
    cerrarElemento(Login);
    cerrarElemento(Register);
    cerrarElemento(Perfil);
    cerrarElemento(AvatarModal); 
    
    // Cierra el overlay
    cerrarElemento(overlay);
}


document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById('overlay');
    
    // --- 1. Cierre al hacer clic en el Overlay ---
    overlay.addEventListener("click", () => {
        // Al hacer clic, ejecuta la función de cierre global
        cerrarModalesGlobalmente();
    });

    // --- 2. Cierre al presionar la tecla ESCAPE ---
    window.addEventListener("keydown", (event) => {
        // Verifica si la tecla presionada es 'Escape' o su código es 27
        if (event.key === 'Escape' || event.keyCode === 27) {
            
            // Si cualquier modal está activo, prevenimos la acción por defecto
            // y ejecutamos la función de cierre
            cerrarModalesGlobalmente();
            
            // Opcional: Esto puede evitar que el navegador haga algo (como detener la carga)
            // event.preventDefault(); 
        }
    });

});