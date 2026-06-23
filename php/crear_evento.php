<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $_SESSION['usuario_id'];
    
    // Extraemos variables clave para validar fácilmente
    $titulo = trim($data['titulo'] ?? '');
    $fecha = $data['fecha'] ?? '';
    $hora_inicio = $data['hora_inicio'] ?? '';

    // 1. VALIDACIÓN BÁSICA (Añadida)
    if (empty($titulo) || empty($fecha)) {
        echo json_encode(['success' => false, 'message' => 'El título y la fecha son obligatorios.']);
        exit;
    }

    // 2. VALIDACIÓN DE CONFLICTO DE HORARIO
    if (!empty($hora_inicio)) {
        $stmt_conflicto = $conn->prepare("
            SELECT titulo, 'Tarea' as origen FROM tareas WHERE user_id = :uid AND fecha = :fecha AND hora = :hora
            UNION 
            SELECT titulo, 'Evento' as origen FROM eventos WHERE user_id = :uid AND fecha = :fecha AND hora_inicio = :hora
        ");
        // Usamos la hora_inicio del evento para buscar el choque
        $stmt_conflicto->execute([':uid' => $user_id, ':fecha' => $fecha, ':hora' => $hora_inicio]);
        
        if ($conflicto = $stmt_conflicto->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode([
                'success' => false, 
                'es_conflicto' => true, 
                'message' => "Ya tienes un(a) <b>{$conflicto['origen']}</b> programado a esta hora: <br><i>\"{$conflicto['titulo']}\"</i>."
            ]);
            exit;
        }
    }

    // 3. GUARDADO EN BASE DE DATOS
    try {
        $stmt = $conn->prepare("INSERT INTO eventos (user_id, titulo, tipo, ubicacion, vestimenta, fecha, hora_inicio, hora_fin, detalles) VALUES (:user_id, :titulo, :tipo, :ubicacion, :vestimenta, :fecha, :hora_inicio, :hora_fin, :detalles)");
        
        $stmt->execute([
            ':user_id' => $user_id,
            ':titulo' => $data['titulo'],
            ':tipo' => $data['tipo'],
            ':ubicacion' => $data['ubicacion'],
            ':vestimenta' => $data['vestimenta'],
            ':fecha' => $data['fecha'],
            ':hora_inicio' => $data['hora_inicio'],
            ':hora_fin' => $data['hora_fin'],
            ':detalles' => $data['detalles']
        ]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>