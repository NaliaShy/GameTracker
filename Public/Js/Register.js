// ===============================================
// REGISTER.JS: LÓGICA DE FORMULARIO DE REGISTRO
// ===============================================
document.addEventListener("DOMContentLoaded", () => {
  const registerForm = document.getElementById("registerForm");
  const registerModal = document.getElementById("registerModal"); 
  const cerrarRegistro = document.getElementById("cerrarRegistro"); 
  const registerMsg = document.getElementById("registerMsg"); 

  // La función 'cerrarElemento' se obtiene globalmente desde Sidebar.js

  // Función para cerrar el modal de registro al hacer clic en 'x'
  if (cerrarRegistro) {
    cerrarRegistro.addEventListener('click', () => {
      // USAMOS LA FUNCIÓN GLOBAL:
      if (typeof cerrarElemento === 'function') {
        cerrarElemento(registerModal); 
      } else {
        registerModal.classList.remove("active");
        window.closeAll && window.closeAll(); 
      }
    });
  }

  // Lógica para el envío del formulario de registro
  if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      // Limpiar mensaje previo
      if (registerMsg) {
        registerMsg.textContent = "";
      }

      const fd = new FormData(registerForm);

      try {
        const respuesta = await fetch("http://localhost/GameTracker/src/controllers/registerController.php", {
          method: "POST",
          body: fd
        });

        const texto = await respuesta.text();

        if (texto.trim() === "OK") {
          // Mensaje de éxito
          if (registerMsg) {
            registerMsg.textContent = "¡Registro exitoso! Ya puedes iniciar sesión.";
            registerMsg.style.color = "green";
          }
          
          registerForm.reset();
          // Opcional: Cerrar registro y abrir login
          // window.openSeccion && window.openSeccion(); 

        } else {
          // Mensaje de error desde PHP
          if (registerMsg) {
            registerMsg.textContent = texto.trim() || "Error desconocido en el registro";
            registerMsg.style.color = "red";
          }
        }

      } catch (err) {
        console.error("Error registro", err);
        if (registerMsg) {
          registerMsg.textContent = "Error en el servidor al intentar registrar";
          registerMsg.style.color = "red";
        }
      }
    });
  }
});