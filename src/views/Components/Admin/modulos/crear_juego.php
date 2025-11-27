<h3>Crear Nuevo Juego</h3>
<div id="resultadoCreacion"></div>

<form id="formCrearJuego" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="crear">

    <div class="form-group">
        <label for="titulo">Título del Juego: <span class="required">*</span></label>
        <input type="text" id="titulo" class="form-texto" name="titulo" required maxlength="150">
    </div>

    <div class="form-group">
        <label for="public_id">Editor Principal: <span class="required">*</span></label>
        <select id="public_id" class="form-texto" name="public_id" required>
            <option value="">-- Seleccionar Editor --</option>
            <?php
            $stmt = $pdo->prepare("SELECT public_id AS id, public_nombre AS nombre FROM publicador");
            $stmt->execute();
            $publicadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($publicadores as $publicador):
                echo "<option class='form-texto' value='{$publicador['id']}'>{$publicador['nombre']}</option>";
            endforeach;
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="descripcion_larga_detalle">Descripción Completa:</label>
        <textarea id="descripcion_detalle" class="form-texto" name="descripcion_detalle" rows="6"></textarea>

    </div>

    <div class="form-row">
        <div class="form-group form-group-half">
            <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
            <input type="date" class="form-texto" id="fecha_lanzamiento" name="fecha_lanzamiento">
        </div>

        <div class="form-group form-group-half form-group-multiple">
            <label>Géneros Aplicables: <span class="required">*</span></label>
            <p class="field-tip">Selecciona uno o más (Ctrl/Cmd + click).</p>
            <select id="generos" class="form-texto" name="generos[]" multiple required size="5">
                <?php
                $stmt = $pdo->prepare("SELECT gen_id AS id, gen_nombre AS nombre FROM genero");
                $stmt->execute();
                $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($generos as $genero):
                    echo "<option class='form-texto' value='{$genero['id']}'>{$genero['nombre']}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group form-group-half form-group-multiple">
            <label>Plataformas Compatibles: <span class="required">*</span></label>
            <p class="field-tip">Selecciona una o más (Ctrl/Cmd + click).</p>
            <select id="plataformas" class="form-texto" name="plataformas[]" multiple required size="5">
                <?php
                $stmt = $pdo->prepare("SELECT plataf_id AS id, plataf_nombre AS nombre FROM plataforma");
                $stmt->execute();
                $plataformas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($plataformas as $plataforma):
                    echo "<option class='form-texto' value='{$plataforma['id']}'>{$plataforma['nombre']}</option>";
                endforeach;
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="portada_archivo">Subir Archivo de Portada:</label>
        <input type="file" id="portada_archivo" name="portada_archivo" accept="image/*">
        <p class="field-tip">Formatos aceptados: JPEG, PNG.</p>
    </div>

    <button type="submit" class="btn-primary">💾 Guardar Nuevo Juego</button>
</form>
