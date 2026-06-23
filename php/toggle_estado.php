<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id = $data['id'] ?? null;
    $tipo = $data['tipo'] ?? null; // 'tarea' o 'evento'
    $nuevo_estado = $data['estado'] ?? 'completada';
    $user_id = $_SESSION['usuario_id'];

    if (!$id || !$tipo) {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
        exit;
    }

    try {
        $tabla = ($tipo === 'evento') ? 'eventos' : 'tareas';
        $stmt = $conn->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id AND user_id = :uid");
        $stmt->execute([
            ':estado' => $nuevo_estado,
            ':id' => $id,
            ':uid' => $user_id
        ]);
        
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>