

document.addEventListener("DOMContentLoaded", () => {

    const contenedor = document.getElementById("rating-selector");

    if (!contenedor) {
        console.error("❌ ERROR: No se encontró el div #rating-selector");
        return;
    }

    const juego_id = contenedor.dataset.juegoId;

    if (!juego_id) {
        console.error("❌ ERROR: No existe data-juego-id en #rating-selector");
    } else {
        console.log("✔ juego_id detectado:", juego_id);
    }

    const stars = contenedor.querySelectorAll("span, .star");
    if (stars.length === 0) {
        console.error("❌ ERROR: No se encontraron estrellas dentro de #rating-selector");
        return;
    }

    stars.forEach(star => {
        star.addEventListener("click", () => {
            let rating = star.dataset.value;

            if (!rating) {
                console.error("❌ ERROR: La estrella clickeada no tiene data-value");
                return;
            }

            console.log(`⭐ Rating seleccionado: ${rating}`);

            // activar visualmente
            stars.forEach(s => s.classList.remove("active"));
            for (let i = 0; i < rating; i++) stars[i].classList.add("active");

            // guardar en la DB
            fetch("/GameTracker/src/controllers/SetRating.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ juego_id, rating })
            })
            .then(async r => {
                if (!r.ok) {
                    throw new Error(`❌ Error HTTP: ${r.status}`);
                }

                const data = await r.json();

                if (!data.success) {
                    console.error("❌ Error del servidor:", data.error || "Error desconocido");
                } else {
                    console.log("✔ Rating guardado:", data);
                }
            })
            .catch(err => {
                console.error("❌ ERROR en fetch:", err);
            });
        });
    });
});



function initRating() {
    const contenedor = document.getElementById("rating-selector");

    if (!contenedor) return;

    const juego_id = contenedor.dataset.juegoId;

    if (!juego_id) {
        console.error("❌ Aún no se seteó el data-juego-id");
        return;
    }

    const stars = contenedor.querySelectorAll(".star");

    stars.forEach(star => {
        star.onclick = () => {
            const rating = star.dataset.value;

            stars.forEach(s => s.classList.remove("active"));
            for (let i = 0; i < rating; i++) stars[i].classList.add("active");

            fetch("/GameTracker/src/controllers/SetRating.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ juego_id, rating })
            });
        };
    });
}
