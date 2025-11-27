<div id="gestionJuegos" class="admin-module-content hidden">
    <h2>Gestión de Juegos</h2>
    
    <div class="game-management-layout">
        
        <section class="form-creation-area">
            <h3>Crear Nuevo Juego</h3>
            <form id="formCrearJuego" method="POST" action="/controllers/juegoController.php">
                
                <div class="form-group">
                    <label for="titulo">Título del Juego:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                
                <div class="form-group">
                    <label for="resumen">Resumen Breve:</label>
                    <textarea id="resumen" name="resumen" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
                    <input type="date" id="fecha_lanzamiento" name="fecha_lanzamiento">
                </div>

                <div class="form-group">
                    <label for="editor_id">Editor Principal:</label>
                    <select id="editor_id" name="editor_id">
                        <option value="">-- Seleccionar Editor --</option>
                        <?php 
                            // Ejemplo: $editores = $pdo->query("SELECT editor_id, editor_nombre FROM editor")->fetchAll();
                            // foreach ($editores as $editor) {
                            //     echo "<option value='{$editor['editor_id']}'>{$editor['editor_nombre']}</option>";
                            // }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Guardar Nuevo Juego</button>
                <div id="resultadoCreacion"></div>
            </form>
        </section>
        
        <section class="data-management-links">
            <h3>Gestionar Datos Maestros</h3>
            <p>Define las opciones que se pueden seleccionar para los juegos.</p>
            <ul>
                <li><a href="#" onclick="alert('Cargar módulo para Géneros')">Añadir/Editar Géneros</a></li>
                <li><a href="#" onclick="alert('Cargar módulo para Plataformas')">Añadir/Editar Plataformas</a></li>
                <li><a href="#" onclick="alert('Cargar módulo para Editores')">Añadir/Editar Editores</a></li>
                <li><a href="#" onclick="alert('Cargar módulo para Temas')">Añadir/Editar Temas</a></li>
                </ul>
        </section>

    </div>
</div>

<style>
/* Estilos básicos para el layout de Gestión de Juegos */
.game-management-layout {
    display: flex;
    gap: 30px;
}

.form-creation-area {
    flex: 2; /* Ocupa más espacio para el formulario */
    padding-right: 20px;
    border-right: 1px solid #e9ecef;
}

.data-management-links {
    flex: 1; /* Ocupa un tercio del espacio */
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 6px;
}

.data-management-links ul {
    list-style-type: none;
    padding: 0;
}

.data-management-links li a {
    display: block;
    padding: 8px;
    margin-bottom: 5px;
    background-color: #e9ecef;
    border-radius: 4px;
    color: #333;
    transition: background-color 0.2s;
}

.data-management-links li a:hover {
    background-color: #dee2e6;
    text-decoration: none;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="date"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box; /* Asegura que el padding no cambie el ancho total */
}

.btn-primary {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>