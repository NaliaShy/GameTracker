// ===============================================
// AdminTools.js
// Lógica de navegación y manejo de formularios CRUD para el dashboard de administración.
// ===============================================

/**
 * Muestra el módulo seleccionado de administración (Usuarios, Juegos, etc.)
 * y oculta los demás.
 * @param {string} moduleId - ID del div de contenido a mostrar.
 * @param {HTMLElement} element - El elemento <a> que fue clickeado.
 */
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

// Inicialización de la navegación lateral del panel de administración
document.addEventListener('DOMContentLoaded', () => {
    // Solo intenta inicializar si existe la navegación lateral (es decir, si el usuario es Admin)
    const primerEnlace = document.querySelector('.admin-nav-sidebar a');
    
    if (primerEnlace) { 
        const onclickAttr = primerEnlace.getAttribute('onclick');
        // Usar regex para extraer el ID del módulo de 'mostrarModulo("elID", this)'
        const match = onclickAttr ? onclickAttr.match(/'([^']+)'/) : null;

        if (match && match[1]) {
             mostrarModulo(match[1], primerEnlace);
        } else {
             // Esto evita el error fatal si el formato del onclick no es el esperado.
             console.warn("⚠️ Advertencia: No se pudo inicializar el módulo Admin por defecto.");
        }
    }
});


/**
 * Muestra la sección CRUD interna seleccionada (Crear, Listar, Editar, Eliminar)
 * y actualiza la pestaña activa.
 * @param {string} seccionId - ID del div de contenido a mostrar (ej: 'juegosCrear').
 * @param {HTMLElement} element - El elemento <a> que fue clickeado.
 */
function mostrarCrudSeccion(seccionId, element) {
    // 1. Ocultar todos los contenidos CRUD
    const contenidos = document.querySelectorAll('.crud-seccion');
    contenidos.forEach(div => {
        div.classList.remove('active-crud');
        div.classList.add('hidden-crud');
    });

    // 2. Mostrar el contenido seleccionado
    const seccionActiva = document.getElementById(seccionId);
    if (seccionActiva) {
        seccionActiva.classList.add('active-crud');
        seccionActiva.classList.remove('hidden-crud');
    }

    // 3. Resaltar la pestaña activa
    const pestañas = document.querySelectorAll('.crud-tabs a');
    pestañas.forEach(a => a.classList.remove('active-tab'));
    element.classList.add('active-tab');
}

// Inicialización de las pestañas CRUD internas
document.addEventListener('DOMContentLoaded', () => {
    // Solo inicializa si las pestañas existen
    const primeraPestana = document.querySelector('.crud-tabs a.active-tab');
    if (primeraPestana) {
        // Ejecuta la función de mostrar para asegurar la carga inicial correcta.
        const seccionIdAttr = primeraPestana.getAttribute('onclick');
        const match = seccionIdAttr ? seccionIdAttr.match(/'([^']+)'/) : null;

        if (match && match[1]) {
            mostrarCrudSeccion(match[1], primeraPestana);
        }
    }
});
// ===============================================
// AdminTools.js - Lógica de Creación de Juego
// ===============================================

document.addEventListener('DOMContentLoaded', () => {
    // ... (Mantén aquí la lógica de inicialización de mostrarModulo y mostrarCrudSeccion) ...
    // ... (El código de inicialización que ya te pasé) ...

    const formCrearJuego = document.getElementById('formCrearJuego');
    const resultadoDiv = document.getElementById('resultadoCreacion');
    const btnGuardar = document.querySelector('#formCrearJuego button[type="submit"]');

    if (formCrearJuego) {
        formCrearJuego.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            // 1. Deshabilitar botón para evitar envíos múltiples
            btnGuardar.disabled = true;
            resultadoDiv.innerHTML = '<span class="alerta-info">⏳ Creando juego...</span>';
            resultadoDiv.className = 'alerta-info';

            const formData = new FormData(this);

            fetch('/GameTracker/src/controllers/juegoController.php', { // Ajusta la URL si es necesario
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.json(); // Esperamos una respuesta JSON
            }) 
            .then(data => {
                // 2. Mostrar resultado basado en la respuesta JSON de PHP
                resultadoDiv.innerHTML = '';
                resultadoDiv.className = '';

                if (data.success) {
                    resultadoDiv.classList.add('alerta-exito');
                    resultadoDiv.innerHTML = `✅ ¡Juego creado! ID: <b>${data.juego_id}</b>`;
                    formCrearJuego.reset(); // Limpiar formulario
                    
                    // Opcional: Recargar la tabla de listado
                    // Si tienes una función para recargar la lista:
                    // window.recargarListaJuegos && window.recargarListaJuegos();

                } else {
                    resultadoDiv.classList.add('alerta-error');
                    resultadoDiv.innerHTML = `❌ Error al crear: ${data.message}`;
                }
            })
            .catch(error => {
                // 3. Manejo de errores de red o HTTP
                resultadoDiv.classList.add('alerta-error');
                resultadoDiv.innerHTML = `❌ Error: ${error.message}. Verifica el servidor.`;
                console.error('Error en la petición Fetch:', error);
            })
            .finally(() => {
                // 4. Habilitar botón al finalizar
                btnGuardar.disabled = false;
            });
        });
    }
});

// ===============================================
// AdminTools.js - SOLO LÓGICA DE CREAR JUEGO
// ===============================================

document.addEventListener('DOMContentLoaded', () => {

    const formCrearJuego = document.getElementById('formCrearJuego');
    const resultadoDiv = document.getElementById('resultadoCreacion');
    const btnGuardar = formCrearJuego ? formCrearJuego.querySelector('button[type="submit"]') : null;

    if (formCrearJuego) {
        formCrearJuego.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            btnGuardar.disabled = true;
            resultadoDiv.innerHTML = '<span class="alerta-info">⏳ Creando juego...</span>';
            resultadoDiv.className = 'alerta-info';

            const formData = new FormData(this);

            fetch('/GameTracker/src/controllers/juegoController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                return response.json();
            })
            .then(data => {
                resultadoDiv.innerHTML = '';
                resultadoDiv.className = '';

                if (data.success) {
                    resultadoDiv.classList.add('alerta-exito');
                    resultadoDiv.innerHTML = `✅ ¡Juego creado! ID: <b>${data.juego_id}</b>`;
                    formCrearJuego.reset();

                } else {
                    resultadoDiv.classList.add('alerta-error');
                    resultadoDiv.innerHTML = `❌ Error al crear: ${data.message}`;
                }
            })
            .catch(err => {
                resultadoDiv.classList.add('alerta-error');
                resultadoDiv.innerHTML = `❌ Error: ${err.message}`;
            })
            .finally(() => {
                btnGuardar.disabled = false;
            });
        });
    }
});
