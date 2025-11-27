function mostrarSeccion(id) {
    const secciones = [
        "contenidoNavegar",
        "contenidoDescubre",
        "contenidoMisJuegos",
        "contenidoAdmin"
    ];

    // Ocultar todas
    secciones.forEach(sec => {
        document.getElementById(sec).style.display = "none";
    });

    // Mostrar solo la seleccionada
    document.getElementById(id).style.display = "block";
}


// Muestra el módulo seleccionado y oculta los demás
function mostrarModulo(moduleId, element) {
    // 1. Ocultar todos los módulos de contenido
    const contenidos = document.querySelectorAll('.admin-module-content');
    contenidos.forEach(div => {
        div.classList.remove('active');
        div.classList.add('hidden');
    });

    // 2. Mostrar el módulo seleccionado
    const moduloActivo = document.getElementById(moduleId);
    if (moduloActivo) {
        moduloActivo.classList.add('active');
        moduloActivo.classList.remove('hidden');
    }

    // 3. Resaltar el enlace activo
    const enlaces = document.querySelectorAll('.admin-nav-sidebar a');
    enlaces.forEach(a => a.classList.remove('active-nav'));
    element.classList.add('active-nav');
}

// Asegurar que el primer módulo se muestre al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    // Ejecuta la función para el primer enlace (Gestión de Usuarios)
    const primerEnlace = document.querySelector('.admin-nav-sidebar a');
    if (primerEnlace) {
        // Pasamos el ID del primer módulo para activarlo
        const primerModuloId = primerEnlace.getAttribute('onclick').match(/'([^']+)'/)[1];
        mostrarModulo(primerModuloId, primerEnlace);
    }
});
