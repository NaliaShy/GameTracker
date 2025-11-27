// ===============================================
// SIDEBAR.JS: FUNCIÓNES GLOBALES INMEDIATAS
// ===============================================

// Función de utilidad GLOBAL (Acceso inmediato para Login.js y Register.js)
function cerrarElemento(el) {
    if (el) {
        el.classList.remove("active");
    }
}
window.cerrarElemento = cerrarElemento;

// Función de ayuda para abrir un elemento (GLOBAL INMEDIATA)
function openElement(el) {
    const overlay = document.getElementById('overlay');
    if (!el) {
        console.warn('❌ Elemento a abrir no encontrado.', el);
        return;
    }
    el.classList.add('active');
    overlay?.classList.add('active');
}

// -----------------------------------------------------------
// FUNCIONES GLOBALES DE APERTURA (Disponibles para el onclick)
// -----------------------------------------------------------

window.openPerfil = function () { openElement(document.getElementById('perfilModal')); };
window.openSeccion = function () { openElement(document.getElementById('loginModal')); }; // <-- ¡El que no abría!
window.openCuenta = function () { openElement(document.getElementById('registerModal')); };
window.cuenta = function () { openElement(document.getElementById("avatarSelectionModalWrapper")); }; // Para el modal de avatar

// -----------------------------------------------------------
// LÓGICA DE CIERRE GLOBAL (se define dentro del DOMContentLoaded)
// -----------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById('overlay');
    const sidebar = document.getElementById('sidebar');

    // Cierra todos los modales, sidebar y el overlay.
    function closeAll() {
        console.log('closeAll invoked');
        sidebar?.classList.remove('active');
        cerrarElemento(document.getElementById('perfilModal'));
        cerrarElemento(document.getElementById('registerModal'));
        cerrarElemento(document.getElementById('loginModal'));
        cerrarElemento(document.getElementById("avatarSelectionModalWrapper"));
        overlay?.classList.remove('active');
    }
    window.closeAll = closeAll;

    // Toggle del menú lateral
    window.toggleMenu = function () {
        sidebar?.classList.toggle('active');
        if (sidebar?.classList.contains('active')) overlay.classList.add('active');
        else {
            const anyModalOpen = [
                document.getElementById('perfilModal'),
                document.getElementById('registerModal'),
                document.getElementById('loginModal'),
                document.getElementById("avatarSelectionModalWrapper")
            ].some(m => m?.classList.contains('active'));
            if (!anyModalOpen) closeAll();
        }
    };

    // Manejo de eventos de cierre
    overlay?.addEventListener('click', (e) => {
        if (e.target === overlay) closeAll();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAll();
    });
});