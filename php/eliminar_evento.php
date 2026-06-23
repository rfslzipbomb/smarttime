<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $evento_id = $data['id'] ?? null;
    $user_id = $_SESSION['usuario_id'];

    if (!$evento_id) {
        echo json_encode(['success' => false, 'message' => 'ID de evento no proporcionado.']);
        exit;
    }

    try {
        $stmt = $conn->prepare("DELETE FROM eventos WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            ':id' => $evento_id,
            ':user_id' => $user_id
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Evento eliminado.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>