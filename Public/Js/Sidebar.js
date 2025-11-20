document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById('overlay');
    const sidebar = document.getElementById('sidebar');
    const perfil = document.getElementById('perfilModal');
    const cuenta = document.getElementById('registerModal');
    const login = document.getElementById('loginModal');

    if (!overlay) console.warn('No se encontró #overlay en el DOM');
    console.log('overlay elements found:', document.querySelectorAll('#overlay').length);

    function closeAll() {
        console.log('closeAll invoked');
        sidebar?.classList.remove('active');
        perfil?.classList.remove('active');
        cuenta?.classList.remove('active');
        login?.classList.remove('active');
        overlay?.classList.remove('active');
    }

    function openElement(el) {
        if (!el) {
            console.warn('Elemento a abrir no encontrado', el);
            return;
        }
        el.classList.add('active');
        overlay.classList.add('active');
    }

    window.toggleMenu = function () {
        sidebar?.classList.toggle('active');
        if (sidebar?.classList.contains('active')) overlay.classList.add('active');
        else {
            const anyModalOpen = [perfil, cuenta, login].some(m => m?.classList.contains('active'));
            if (!anyModalOpen) overlay.classList.remove('active');
        }
    };

    window.openPerfil = function () { openElement(perfil); };
    window.openSeccion = function () { openElement(login); };
    window.openCuenta = function () { openElement(cuenta); };

    overlay?.addEventListener('click', (e) => {
        if (e.target === overlay) closeAll();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAll();
    });
});