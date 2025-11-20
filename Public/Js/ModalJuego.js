// ======================
// MODAL DETALLES JUEGO
// ======================

const modal = document.getElementById('juegoDetallesModal');
const cerrarBtn = document.getElementById('cerrarJuegoDetalles');

const juegoCover = document.getElementById('juegoCover');
const juegoTitulo = document.getElementById('juegoTitulo');
const juegoDescripcion = document.getElementById('juegoDescripcion');
const totalComentarios = document.getElementById('totalComentarios');
const listaComentarios = document.getElementById('listaComentarios');
const juegoIdComentario = document.getElementById('juegoIdComentario');

function openModal() {
    modal.classList.add('active');
    overlay.classList.add('active');
}

function closeModal() {
    modal.classList.remove('active');
    overlay.classList.remove('active');
}

cerrarBtn?.addEventListener('click', closeModal);
overlay?.addEventListener('click', () => closeModal());
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

document.body.addEventListener('click', (e) => {

    const card = e.target.closest('.juego-card');
    if (!card) return;
    e.preventDefault();

    const juegoId = card.dataset.juegoId;
    if (!juegoId) return;

    openModal();

    // Reset modal
    juegoCover.src = "";
    juegoTitulo.textContent = "Cargando...";
    juegoDescripcion.textContent = "";
    listaComentarios.innerHTML = "";
    totalComentarios.textContent = "0";

    const url = `/GameTracker/src/controllers/fetchGameDetails.php?id=${encodeURIComponent(juegoId)}`;
    fetch(url)
        .then(r => r.json())
        .then(data => {

            if (data.success !== undefined && data.data) data = data.data;

            juegoCover.src = data.cover_url || '../../img/sin_portada.png';
            juegoTitulo.textContent = data.nombre || 'Sin título';
            juegoDescripcion.textContent = data.descripcion || 'Sin descripción';
            totalComentarios.textContent = data.totalComentarios ?? data.comentarios.length;
            document.getElementById("rating-selector").dataset.juegoId = data.id;
            initRating();

            if (juegoIdComentario) juegoIdComentario.value = data.id;

            const ratingSelector = document.getElementById("rating-selector");
            if (ratingSelector) {
                ratingSelector.dataset.juegoId = data.id;
                console.log("ID del juego cargado al rating:", data.id);
            }

            listaComentarios.innerHTML = data.comentarios.map(c => `
                <div class="comentario">
                    <strong>${escapeHtml(c.user_nombre)}</strong>
                    <p>${escapeHtml(c.comentario_texto)}</p>
                </div>
            `).join('');

            // Inicializar rating ahora que tenemos juego_id
            initRating();

            // Mostrar rating promedio o guardado
            mostrarRating(juegoId);

        })
        .catch(err => {
            console.error(err);
            juegoTitulo.textContent = "Error";
            juegoDescripcion.textContent = "No se pudieron cargar los detalles.";
        });
});

// ======================
// PUBLICAR COMENTARIO
// ======================

const comentarioForm = document.getElementById("comentarioForm");
const comentarioTexto = document.getElementById("comentarioTexto");
const comentarioMensaje = document.getElementById("comentarioMensaje");

if (comentarioForm) {
    comentarioForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const fd = new FormData(comentarioForm);

        fetch("/GameTracker/src/controllers/guardarComentario.php", {
            method: "POST",
            body: fd
        })
            .then(r => r.json())
            .then(res => {
                if (!res.success) {
                    comentarioMensaje.textContent = res.error || "Error al publicar.";
                    comentarioMensaje.style.color = "red";
                    return;
                }

                comentarioMensaje.textContent = "Comentario publicado.";
                comentarioMensaje.style.color = "green";

                listaComentarios.innerHTML = `
                    <div class="comentario">
                        <strong>Tú</strong>
                        <p>${escapeHtml(comentarioTexto.value)}</p>
                    </div>
                ` + listaComentarios.innerHTML;

                comentarioTexto.value = "";
                totalComentarios.textContent = parseInt(totalComentarios.textContent) + 1;
            })
            .catch(err => {
                console.error(err);
                comentarioMensaje.textContent = "Error en el servidor.";
                comentarioMensaje.style.color = "red";
            });
    });
}

function escapeHtml(str = '') {
    return String(str).replace(/[&<>"']/g, (c) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    })[c]);
}

// ======================
// RATING
// ======================

function initRating() {
    const contenedor = document.getElementById("rating-selector");
    if (!contenedor) return;

    const juegoId = contenedor.dataset.juegoId;
    if (!juegoId) {
        console.error("❌ Aún no se seteó el data-juego-id");
        return;
    }

    const stars = contenedor.querySelectorAll(".star");
    if (!stars.length) return;

    let ratingActual = 0;

    function marcar(valor) {
        stars.forEach((s, idx) => s.classList.toggle("active", idx < valor));
    }

    stars.forEach(star => {
        const valor = parseInt(star.dataset.value);

        star.addEventListener("mouseover", () => marcar(valor));
        star.addEventListener("mouseout", () => marcar(ratingActual));

        star.addEventListener("click", () => {
            ratingActual = valor;
            marcar(ratingActual);

            fetch("/GameTracker/src/controllers/SetRating.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ juego_id: juegoId, rating: ratingActual })
            })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) console.error("❌ Error del servidor:", data.error);
                    else console.log("✔ Rating guardado:", data);
                })
                .catch(err => console.error("❌ ERROR en fetch:", err));
        });
    });
}

function mostrarRating(juegoId) {
    const contenedor = document.getElementById("ratingStars");
    const valorTexto = document.getElementById("ratingValor");
    if (!contenedor) return;

    fetch(`../../src/controllers/GetRating.php?juego_id=${juegoId}`)
        .then(res => res.json())
        .then(data => {

            contenedor.innerHTML = "";
            let ratingActual = data.rating ? parseInt(data.rating) : 0;

            for (let i = 1; i <= 5; i++) {
                let estrella = document.createElement("span");
                estrella.classList.add("star");
                estrella.textContent = "★";
                estrella.dataset.valor = i;

                if (i <= ratingActual) estrella.classList.add("active");

                estrella.addEventListener("mouseover", () => marcar(i));
                estrella.addEventListener("mouseout", () => marcar(ratingActual));

                estrella.addEventListener("click", () => {
                    guardarRating(juegoId, i);
                    ratingActual = i;
                    marcar(ratingActual);
                    valorTexto.textContent = `Tu calificación: ${i}/5`;
                });

                contenedor.appendChild(estrella);
            }

            valorTexto.textContent = ratingActual === 0
                ? "No has calificado este juego."
                : `Tu calificación: ${ratingActual}/5`;

            function marcar(valor) {
                const estrellas = contenedor.querySelectorAll(".star");
                estrellas.forEach((s, idx) => {
                    s.classList.toggle("active", idx < valor);
                });
            }
        });
}

function guardarRating(juegoId, estrellas) {
    fetch("../../src/controllers/SetRating.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ juego_id: juegoId, rating: estrellas })
    })
        .then(res => res.json())
        .then(data => {
            if (!data.success) alert("No se pudo guardar el rating");
        });
}