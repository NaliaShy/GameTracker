// ===============================================
// LOGIN.JS: LIMPIO
// ===============================================
document.addEventListener("DOMContentLoaded", () => {

    const loginForm = document.getElementById("loginForm");
    const loginMsg = document.getElementById("loginMsg");
    const loginModal = document.getElementById("loginModal");
    // const overlay = document.getElementById("overlay"); // Ya no es necesario aquí

    // NOTA: La función 'cerrarElemento(el)' es global y viene de Sidebar.js


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

                    // cerrar modal: USA LA FUNCIÓN GLOBAL DE Sidebar.js
                    if (typeof cerrarElemento === 'function') {
                        cerrarElemento(loginModal); 
                    } else {
                        // En caso de fallo (fallback)
                        loginModal.classList.remove("active");
                        window.closeAll && window.closeAll();
                    }

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