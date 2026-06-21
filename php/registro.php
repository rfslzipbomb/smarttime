<?php
// registro.php
require_once __DIR__ . '/../config/database.php';

$appRoot = dirname(dirname($_SERVER['SCRIPT_NAME']));
if ($appRoot === '/' || $appRoot === '\\') {
    $appRoot = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($nombre) || empty($email) || empty($password) || !isset($_FILES['foto_perfil'])) {
        die("Por favor, rellena todos los campos obligatorios.");
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Procesar archivo
    $file = $_FILES['foto_perfil'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_error = $file['error'];
    
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg'];

    if ($file_error !== 0) {
        die("Hubo un error al cargar la foto de perfil.");
    }

    if (!in_array($file_ext, $allowed_extensions)) {
        die("Formato no permitido. Solo se aceptan archivos JPG o JPEG.");
    }

    $upload_dir = __DIR__ . '/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $new_file_name = uniqid('', true) . '.' . $file_ext;
    $destination = $upload_dir . $new_file_name;

    if (move_uploaded_file($file_tmp, $destination)) {
        // Guardar la ruta pública relativa desde la raíz del proyecto
        // Como los archivos se suben a `php/uploads/`, guardamos esa ruta
        $ruta_db = 'php/uploads/' . $new_file_name;

        try {
            // Guardamos en la columna 'name'
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, foto) VALUES (:name, :email, :password, :foto)");
            $stmt->execute([
                ':name' => $nombre,
                ':email' => $email,
                ':password' => $password_hash,
                ':foto' => $ruta_db
            ]);

            header("Location: {$appRoot}/index.php?registro=exito");
            exit();

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                die("El correo electrónico ya se encuentra registrado.");
            } else {
                die("Error al guardar en la base de datos: " . $e->getMessage());
            }
        }
    } else {
        die("Error al guardar la foto de perfil en el servidor.");
    }
} else {
    header("Location: {$appRoot}/index.php");
    exit();
}
?>