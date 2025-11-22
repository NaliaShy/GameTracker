document.addEventListener("DOMContentLoaded", () => {
  const registerForm = document.getElementById("registerForm");
  const registerModal = document.getElementById("registerModal"); // ID del modal de registro
  const cerrarRegistro = document.getElementById("cerrarRegistro"); // ID del botón cerrar 'x'
  // ASUME que tienes un elemento para mostrar mensajes de registro
  const registerMsg = document.getElementById("registerMsg"); 

  // Función para cerrar el modal de registro al hacer clic en 'x'
  if (cerrarRegistro) {
    cerrarRegistro.addEventListener('click', () => {
      cerrarElemento(registerModal);
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
        // Ajusta la URL al controlador de registro de PHP
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
          
          // Opcional: Limpiar formulario y/o cerrar modal después de un registro exitoso
          registerForm.reset();
          // Puedes optar por cerrar el modal de registro y abrir el de login aquí si es la UX deseada
          // cerrarElemento(registerModal); 

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

}); // Fin del DOMContentLoaded