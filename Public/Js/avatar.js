// Dentro de la función initAvatarSelection() que se asocia al botón 'saveAvatarBtn':
saveButton.addEventListener('click', async () => {
    // 1. Prepara los datos
    const fd = new FormData();
    fd.append('avatarPath', selectedAvatarPath); // <-- Aquí se adjunta el dato crucial
    
    // 2. Hace la petición POST al controlador
    const respuesta = await fetch("http://localhost/GameTracker/src/controllers/updateAvatarController.php", {
        method: "POST",
        body: fd // Envía el FormData
    });

    // 3. Maneja la respuesta del PHP (OK o Error)
    const texto = await respuesta.text();
    // ...
});