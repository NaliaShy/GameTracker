const btnAbrirIniciarSeccion = document.getElementById("btnAbrirIniciarSeccion");
const btnAbrirCrearCuenta = document.getElementById("btnAbrirCrearCuenta");
const modalIniciar = document.getElementById("modal-iniciar-seccion");
const modalCrear = document.getElementById("modal-crear-cuenta");
const cerrarIniciar = document.querySelector(".cerrarIniciar");
const cerrarCrear = document.querySelector(".cerrarCrear");

// Abrir modal
btnAbrirIniciarSeccion.addEventListener("click", function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
    modalIniciar.style.display = "block";
});
btnAbrirCrearCuenta.addEventListener("click", function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
    modalCrear.style.display = "block";
});

// Cerrar modal
cerrarIniciar.addEventListener("click", function() {
    modalIniciar.style.display = "none";
});
// Cerrar modal
cerrarCrear.addEventListener("click", function() {
    modalCrear.style.display = "none";
});
// Cerrar haciendo clic afuera
window.addEventListener("click", function(e) {
    if (e.target === modalIniciar) {
        modalIniciar.style.display = "none";
    }
});
window.addEventListener("click", function(e) {
    if (e.target === modalCrear) {
        modalCrear.style.display = "none";
    }
});
