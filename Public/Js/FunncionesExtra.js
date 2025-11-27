// Este es el código que DEBES tener en FunncionesExtra.js
function mostrarSeccion(id) {
    const secciones = [
        "contenidoNavegar",
        "contenidoDescubre",
        "contenidoMisJuegos",
        "contenidoAdmin"
    ];

    // 1. Ocultar todas: remover la clase 'active' de todas
    secciones.forEach(secId => {
        const elemento = document.getElementById(secId);
        if (elemento) {
            // Asumiendo que usas .content-section en tu HTML
            elemento.classList.remove("active"); 
        }
    });

    // 2. Mostrar solo la seleccionada: añadir la clase 'active'
    const seccionAMostrar = document.getElementById(id);
    if (seccionAMostrar) {
        seccionAMostrar.classList.add("active");
    }
}