<?php
//if (!isset($_SESSION['usuario_id'])) { exit; } 
?>

<div id="avatarSelectionModalWrapper" class="modal">
    <div class="modal-content">

        <div class="modal-close-tittle">
            <h2>Seleccionar Avatar</h2>
        </div>

        <p id="avatarSelectionMsg" style="text-align: center; margin-bottom: 15px;"></p>

        <div id="avatarGallery" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; padding: 10px;">
            <img src="/GameTracker/public/img/avatars/default.png" data-avatar-path="/GameTracker/public/img/avatars/default.png" class="selectable-avatar" alt="Default Avatar">
            <img src="/GameTracker/public/img/avatars/avatar1.png" data-avatar-path="/GameTracker/public/img/avatars/avatar1.png" class="selectable-avatar" alt="Avatar 1">
            <img src="/GameTracker/public/img/avatars/avatar2.png" data-avatar-path="/GameTracker/public/img/avatars/avatar2.png" class="selectable-avatar" alt="Avatar 2">
        </div>

        <button id="saveAvatarBtn" disabled>Guardar Selección</button>
    </div>
</div>