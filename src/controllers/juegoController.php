<?php
require_once __DIR__ . '/../database/conexion.php';
$pdo = getConexion();

// =====================================================================
// 1. CREAR JUEGO (CRUD C)
// =====================================================================
function crearJuego($datos)
{
    global $pdo;

    // 1. Recoger y Sanear Datos
    $titulo = trim($datos['titulo'] ?? '');
    $descripcion_completa = trim($datos['descripcion_detalle'] ?? '');
    $fecha_lanzamiento = empty($datos['fecha_lanzamiento']) ? null : $datos['fecha_lanzamiento'];

    // Editor (publicador)
    $public_id = (int)($datos['public_id'] ?? 0);

    // 1:N – tomamos el primero del array
    $generos_arr = $datos['generos'] ?? [];
    $plataformas_arr = $datos['plataformas'] ?? [];

    $gen_id = !empty($generos_arr) ? (int)$generos_arr[0] : 0;
    $plataf_id = !empty($plataformas_arr) ? (int)$plataformas_arr[0] : 0;

    // Opcionales
    $modjuego_id = !empty($datos['modjuego_id']) ? (int)$datos['modjuego_id'] : null;
    $persp_id = !empty($datos['persp_id']) ? (int)$datos['persp_id'] : null;
    $tema_id = !empty($datos['tema_id']) ? (int)$datos['tema_id'] : null;
    $cover_img_id = !empty($datos['cover_img_id']) ? (int)$datos['cover_img_id'] : null;

    // Validación
    if (empty($titulo) || empty($descripcion_completa) || $public_id <= 0 || $gen_id <= 0 || $plataf_id <= 0) {
        return ['success' => false, 'message' => 'El Título, Descripción Completa, Editor, Género y Plataforma son obligatorios.'];
    }

    try {
        $sql = "INSERT INTO juego (
            juego_nombre,
            juego_descripcion,
            juego_fecha_lanzamiento,
            public_id,
            gen_id,
            plataf_id,
            modjuego_id,
            persp_id,
            tema_id,
            cover_img_id
        ) VALUES (
            :nombre,
            :descripcion,
            :fecha,
            :public_id,
            :gen_id,
            :plataf_id,
            :modjuego_id,
            :persp_id,
            :tema_id,
            :cover_img_id
        )";

        $stmt = $pdo->prepare($sql);

        // Bind
        $stmt->bindValue(':nombre', $titulo);
        $stmt->bindValue(':descripcion', $descripcion_completa);
        $stmt->bindValue(':fecha', $fecha_lanzamiento ?: null, empty($fecha_lanzamiento) ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->bindValue(':public_id', $public_id, PDO::PARAM_INT);
        $stmt->bindValue(':gen_id', $gen_id, PDO::PARAM_INT);
        $stmt->bindValue(':plataf_id', $plataf_id, PDO::PARAM_INT);
        $stmt->bindValue(':modjuego_id', $modjuego_id, PDO::PARAM_INT);
        $stmt->bindValue(':persp_id', $persp_id, PDO::PARAM_INT);
        $stmt->bindValue(':tema_id', $tema_id, PDO::PARAM_INT);
        $stmt->bindValue(':cover_img_id', $cover_img_id, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Juego creado exitosamente.',
            'juego_id' => $pdo->lastInsertId()
        ];
    } catch (PDOException $e) {
        error_log("Error al crear juego: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error de base de datos: revisa que los IDs existan.'];
    }
}


// =====================================================================
// 2. LISTAR JUEGOS (READ)
// =====================================================================
function obtenerTodosLosJuegos()
{
    global $pdo;

    try {
        $sql = "SELECT j.juego_id, j.juego_nombre, j.juego_fecha_lanzamiento, p.public_nombre 
                FROM juego j 
                LEFT JOIN publicador p ON j.public_id = p.public_id
                ORDER BY j.juego_nombre ASC";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Error al listar juegos: " . $e->getMessage());
        return [];
    }
}


// =====================================================================
// 3. OBTENER JUEGO POR ID
// =====================================================================
function obtenerJuegoPorId($juego_id)
{
    global $pdo;

    try {
        $sql = "SELECT * FROM juego WHERE juego_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $juego_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Error al obtener juego: " . $e->getMessage());
        return false;
    }
}


// =====================================================================
// 4. ACTUALIZAR JUEGO (UPDATE)
// =====================================================================
function actualizarJuego($juego_id, $datos)
{
    global $pdo;

    $titulo = trim($datos['titulo'] ?? '');
    $descripcion = trim($datos['descripcion_larga_detalle'] ?? '');
    $fecha_lanzamiento = $datos['fecha_lanzamiento'] ?? null;
    $public_id = (int)($datos['public_id'] ?? 0);

    if (empty($titulo) || empty($descripcion)) {
        return ['success' => false, 'message' => 'Datos incompletos para actualizar.'];
    }

    try {
        $sql = "UPDATE juego SET 
                juego_nombre = :nombre,
                juego_descripcion = :descripcion,
                juego_fecha_lanzamiento = :fecha,
                public_id = :public_id
                WHERE juego_id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':nombre', $titulo);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':fecha', $fecha_lanzamiento);
        $stmt->bindValue(':public_id', $public_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $juego_id, PDO::PARAM_INT);

        $stmt->execute();

        return ['success' => true, 'message' => 'Juego actualizado exitosamente.'];

    } catch (PDOException $e) {
        error_log("Error al actualizar juego: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error de base de datos al actualizar.'];
    }
}


// =====================================================================
// 5. ROUTER POST AJAX
// =====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    $action = $_POST['action'];
    $resultado = ['success' => false, 'message' => 'Acción no válida.'];

    switch ($action) {
        case 'crear':
            $resultado = crearJuego($_POST);
            break;

        case 'actualizar':
            if (isset($_POST['juego_id'])) {
                $resultado = actualizarJuego((int)$_POST['juego_id'], $_POST);
            } else {
                $resultado = ['success' => false, 'message' => 'ID de juego faltante para actualizar.'];
            }
            break;
    }

    echo json_encode($resultado);
    exit;
}

?>
