<div id="juegoDetallesModal" class="Juego-modal">
    <div class="modal-content large-modal-content">
        <div class="modal-close-tittle">
            <span class="close" id="cerrarJuegoDetalles">&times;</span>
        </div>

        <div id="juegoContenidoDinamico">
            <div class="juego-header">
                <img id="juegoCover" src="" alt="Portada del juego">
                <h2 id="juegoTitulo"></h2>
            </div>

            <div class="juego-info-section">
                <h3>Descripción</h3>
                <p id="juegoDescripcion"></p>
            </div>

            <div class="juego-rating-section">
                <div class="tu-calificacion">Tu calificación</div>

                <?php if ($_SESSION['usuario_id']) { ?>
                    <div id="rating-selector" data-juego-id="">
                        <div class="stars">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="login-prompt">Debes iniciar sesión para calificar</div>
                <?php } ?>
            </div>


            <div class="juego-comentarios-section">
                <h3>Comentarios (<span id="totalComentarios">0</span>)</h3>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <form id="comentarioForm">
                        <input type="hidden" id="juegoIdComentario" name="juego_id">
                        <textarea id="comentarioTexto" name="comentario_texto" rows="3" placeholder="Escribe tu comentario aquí..."></textarea>
                        <button type="submit" id="btnEnviarComentario">Publicar</button>
                        <div id="comentarioMensaje" style="margin-top: 10px;"></div>
                    </form>
                <?php else: ?>
                    <p class="login-prompt">Debes <a href="#" id="abrirLoginDesdeJuego">iniciar sesión</a> para comentar.</p>
                <?php endif; ?>

                <div id="listaComentarios" class="lista-comentarios">
                </div>
            </div>
        </div>
    </div>
</div>