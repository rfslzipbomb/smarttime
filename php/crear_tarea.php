<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

// Indicamos que responderemos en formato JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leemos los datos enviados por Javascript (Fetch)
    $data = json_decode(file_get_contents("php://input"), true);
    
    $user_id = $_SESSION['usuario_id'];
    $titulo = trim($data['titulo'] ?? '');
    $categoria = $data['categoria'] ?? 'Trabajo';
    $fecha = $data['fecha'] ?? '';
    $hora = $data['hora'] ?? '';
    $descripcion = $data['descripcion'] ?? '';

    // Validación básica
    if (empty($titulo) || empty($fecha)) {
        echo json_encode(['success' => false, 'message' => 'El título y la fecha son obligatorios.']);
        exit;
    }

    // --- NUEVO: Verificación de conflictos de horario ---
    if (!empty($hora)) {
        // Buscamos si hay una tarea O un evento a la misma fecha y hora
        $stmt_conflicto = $conn->prepare("
            SELECT titulo, 'Tarea' as origen FROM tareas WHERE user_id = :uid AND fecha = :fecha AND hora = :hora
            UNION 
            SELECT titulo, 'Evento' as origen FROM eventos WHERE user_id = :uid AND fecha = :fecha AND hora_inicio = :hora
        ");
        $stmt_conflicto->execute([':uid' => $user_id, ':fecha' => $fecha, ':hora' => $hora]);
        
        if ($conflicto = $stmt_conflicto->fetch(PDO::FETCH_ASSOC)) {
            // Si encuentra algo, detenemos todo y devolvemos el error de conflicto
            echo json_encode([
                'success' => false, 
                'es_conflicto' => true, 
                'message' => "Ya tienes un(a) <b>{$conflicto['origen']}</b> programado a esta hora: <br><i>\"{$conflicto['titulo']}\"</i>."
            ]);
            exit;
        }
    }
    // --- FIN VERIFICACIÓN ---

    try {
        $stmt = $conn->prepare("INSERT INTO tareas (user_id, titulo, categoria, fecha, hora, descripcion) VALUES (:user_id, :titulo, :categoria, :fecha, :hora, :descripcion)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':titulo' => $titulo,
            ':categoria' => $categoria,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':descripcion' => $descripcion
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Tarea creada exitosamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()]);
    }
}
?>