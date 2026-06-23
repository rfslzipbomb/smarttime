<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$user_id = $_SESSION['usuario_id'];

try {
    // Obtenemos las tareas del usuario logueado, ordenadas por fecha y hora
    $stmt = $conn->prepare("SELECT * FROM tareas WHERE user_id = :user_id ORDER BY fecha ASC, hora ASC");
    $stmt->execute([':user_id' => $user_id]);
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'tareas' => $tareas]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>