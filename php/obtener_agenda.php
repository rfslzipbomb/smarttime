<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json');

$user_id = $_SESSION['usuario_id'];

try {
    // Obtenemos Tareas
    $stmtTareas = $conn->prepare("SELECT * FROM tareas WHERE user_id = :user_id");
    $stmtTareas->execute([':user_id' => $user_id]);
    $tareas = $stmtTareas->fetchAll(PDO::FETCH_ASSOC);

    // Obtenemos Eventos
    $stmtEventos = $conn->prepare("SELECT * FROM eventos WHERE user_id = :user_id");
    $stmtEventos->execute([':user_id' => $user_id]);
    $eventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'tareas' => $tareas, 'eventos' => $eventos]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>