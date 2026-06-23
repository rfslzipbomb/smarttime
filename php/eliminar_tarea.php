<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $tarea_id = $data['id'] ?? null;
    $user_id = $_SESSION['usuario_id'];

    if (!$tarea_id) {
        echo json_encode(['success' => false, 'message' => 'ID de tarea no proporcionado.']);
        exit;
    }

    try {
        // Solo permitimos eliminar si la tarea le pertenece a este usuario
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            ':id' => $tarea_id,
            ':user_id' => $user_id
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Tarea eliminada.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>