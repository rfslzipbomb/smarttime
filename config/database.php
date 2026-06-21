<?php
// config/database.php

// Definimos la ruta absoluta hacia la carpeta database en la raíz
$db_path = __DIR__ . '/../database/smart_time.sqlite';

try {
    // Crear la carpeta database si no existe
    if (!file_exists(dirname($db_path))) {
        mkdir(dirname($db_path), 0777, true);
    }

    // Inicializamos la conexión PDO que necesitan tus otros scripts
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Creamos la tabla de usuarios
    $conn->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        foto TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )");

} catch(PDOException $e) {
    die("Error crítico de base de datos: " . $e->getMessage());
}
?>