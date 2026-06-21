<?php
// login.php
$session_dir = __DIR__ . '/../sessions';
if (!file_exists($session_dir)) {
    mkdir($session_dir, 0777, true);
}
ini_set('session.save_path', $session_dir);
session_start();
require_once __DIR__ . '/../config/database.php';

$appRoot = dirname(dirname($_SERVER['SCRIPT_NAME']));
if ($appRoot === '/' || $appRoot === '\\') {
    $appRoot = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        header("Location: {$appRoot}/index.php?error=campos_vacios");
        exit();
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Sincronizado con el campo 'name' de SQLite
            $_SESSION['usuario_id']    = $usuario['id'];
            $_SESSION['usuario_name']  = $usuario['name']; 
            $_SESSION['usuario_email'] = $usuario['email'];
            // Normalizar ruta de la foto para que sea accesible desde la raíz web
            $foto_db = $usuario['foto'];
            $public_foto = $foto_db;
            $projectRoot = realpath(__DIR__ . '/../');
            // Si la ruta guardada no apunta a un archivo válido, probar con/ sin prefijo 'php/'
            if (!empty($public_foto) && !file_exists($projectRoot . '/' . $public_foto)) {
                if (strpos($public_foto, 'php/') === 0) {
                    $candidate = substr($public_foto, 4);
                    if (file_exists($projectRoot . '/' . $candidate)) {
                        $public_foto = $candidate;
                    }
                } else {
                    $candidate = 'php/' . $public_foto;
                    if (file_exists($projectRoot . '/' . $candidate)) {
                        $public_foto = $candidate;
                    }
                }
            }
            $_SESSION['usuario_foto']  = $public_foto; 

            // Redirección con código HTTP de movimiento de cabeceras
            header("Location: {$appRoot}/tareas.php");
            exit();
        } else {
            header("Location: {$appRoot}/index.php?error=credenciales");
            exit();
        }

    } catch (PDOException $e) {
        die("Error en el inicio de sesión: " . $e->getMessage());
    }
} else {
    header("Location: {$appRoot}/index.php");
    exit();
}
?>