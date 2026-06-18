<?php
// login.php
session_start(); 
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        header("Location: index.html?error=campos_vacios");
        exit();
    }

    try {
        // 1. Buscar al usuario por correo electrónico
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Verificar existencia y contrastar el Hash de la contraseña
        if ($usuario && password_verify($password, $usuario['password'])) {
            
            // 3. Variables de sesión (Asegúrate de que las llaves coincidan con tus columnas de SQLite)
            $_SESSION['usuario_id']    = $usuario['id'];
            $_SESSION['usuario_name']  = $usuario['name']; // Si en tu BD dice 'nombre', cámbialo aquí a $usuario['nombre']
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_foto']  = $usuario['foto']; 

            // 4. Redirección forzada al panel dinámico
            header("Location: tareas.php");
            exit();
        } else {
            // Si las credenciales fallan, volvemos mandando el parámetro de error
            header("Location: index.html?error=credenciales");
            exit();
        }

    } catch (PDOException $e) {
        // En desarrollo en Fedora, si algo truena con SQLite, esto te dirá exactamente qué pasó
        die("Error crítico en la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: index.html");
    exit();
}
?>