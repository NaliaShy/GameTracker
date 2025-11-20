document.addEventListener("DOMContentLoaded", () => {

    const loginForm = document.getElementById("loginForm");
    const loginMsg = document.getElementById("loginMsg");
    const loginModal = document.getElementById("loginModal");
    const overlay = document.getElementById("overlay");

    function cerrarElemento(el) {
        el.classList.remove("active");
        overlay.classList.remove("active");
    }

    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const fd = new FormData(loginForm);

            try {
                const respuesta = await fetch("http://localhost/GameTracker/src/controllers/loginController.php", {
                    method: "POST",
                    body: fd
                });

                const texto = await respuesta.text();

                if (texto.trim() === "OK") {
                    // mensaje de éxito
                    if (loginMsg) {
                        loginMsg.textContent = "¡Bienvenido!";
                        loginMsg.style.color = "green";
                    }

                    // cerrar modal
                    cerrarElemento(loginModal);

                    // redirigir
                    window.location.href = "../../views/Home/Home.php";

                } else {
                    // mensaje de error desde PHP
                    if (loginMsg) {
                        loginMsg.textContent = texto.trim() || "Error desconocido";
                        loginMsg.style.color = "red";
                    }
                }

            } catch (err) {
                console.error("Error login", err);
                if (loginMsg) {
                    loginMsg.textContent = "Error en el servidor";
                    loginMsg.style.color = "red";
                }
            }
        });
    }
});
