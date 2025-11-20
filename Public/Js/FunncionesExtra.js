function mostrarSeccion(id) {
    const secciones = [
        "contenidoNavegar",
        "contenidoDescubre",
        "contenidoMisJuegos"
    ];

    // Ocultar todas
    secciones.forEach(sec => {
        document.getElementById(sec).style.display = "none";
    });

    // Mostrar solo la seleccionada
    document.getElementById(id).style.display = "block";
}
