<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

$appRoot = dirname(dirname($_SERVER['SCRIPT_NAME']));
if ($appRoot === '/' || $appRoot === '\\') {
    $appRoot = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['usuario_id'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password_nueva = $_POST['password'];

    if (empty($nombre) || empty($email)) {
        header("Location: {$appRoot}/ajustes.php?error=" . urlencode("El nombre y el correo son obligatorios."));
        exit();
    }

    try {
        // 1. Verificar si el correo ya existe en OTRO usuario
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
        $stmt_check->execute([':email' => $email, ':id' => $id_usuario]);
        if ($stmt_check->fetch()) {
            header("Location: {$appRoot}/ajustes.php?error=" . urlencode("El correo electrónico ya está en uso por otra cuenta."));
            exit();
        }

        // Preparar la consulta base de actualización
        $query = "UPDATE users SET name = :name, email = :email";
        $params = [
            ':name' => $nombre,
            ':email' => $email,
            ':id' => $id_usuario
        ];

        // 2. Verificar si se envió una nueva contraseña
        if (!empty($password_nueva)) {
            $query .= ", password = :password";
            $params[':password'] = password_hash($password_nueva, PASSWORD_BCRYPT);
        }

        // 3. Verificar si se subió una nueva foto
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === 0) {
            $file = $_FILES['foto_perfil'];
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            if (in_array($file_ext, ['jpg', 'jpeg'])) {
                $upload_dir = __DIR__ . '/uploads/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $new_file_name = uniqid('', true) . '.' . $file_ext;
                $destination = $upload_dir . $new_file_name;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    // Misma lógica de rutas que usas en el registro
                    $ruta_db = 'php/uploads/' . $new_file_name;
                    $query .= ", foto = :foto";
                    $params[':foto'] = $ruta_db;
                    
                    // Actualizar variable de sesión de la foto
                    $_SESSION['usuario_foto'] = $ruta_db;
                }
            } else {
                header("Location: {$appRoot}/ajustes.php?error=" . urlencode("Formato de foto no permitido. Solo JPG."));
                exit();
            }
        }

        $query .= " WHERE id = :id";
        
        // Ejecutar actualización
        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        // Actualizar el resto de variables de sesión
        $_SESSION['usuario_name'] = $nombre;
        $_SESSION['usuario_email'] = $email;

        // Redirigir con éxito
        header("Location: {$appRoot}/ajustes.php?mensaje=exito");
        exit();

    } catch (PDOException $e) {
        die("Error al actualizar la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: {$appRoot}/ajustes.php");
    exit();
}
?>