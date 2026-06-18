<?php
// registro.php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Validaciones básicas de campos de texto
    if (empty($nombre) || empty($email) || empty($password) || !isset($_FILES['foto_perfil'])) {
        die("Por favor, rellena todos los campos obligatorios.");
    }

    // Encriptar contraseña por seguridad antes de guardar
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // 2. Procesar la subida del archivo binario ($_FILES)
    $file = $_FILES['foto_perfil'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_error = $file['error'];
    
    // Extraer la extensión y forzar minúsculas
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg'];

    if ($file_error !== 0) {
        die("Hubo un error al cargar el archivo en el servidor.");
    }

    if (!in_array($file_ext, $allowed_extensions)) {
        die("Formato no permitido. Solo se aceptan archivos JPG o JPEG.");
    }

    // 3. Crear la carpeta destino si no existe de forma local
    $upload_dir = __DIR__ . '/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Generar un nombre único para el archivo (ej: 66723b7a8f3c1.jpg)
    $new_file_name = uniqid('', true) . '.' . $file_ext;
    $destination = $upload_dir . $new_file_name;

    // Mover el archivo desde la ubicación temporal del sistema a tu proyecto
    if (move_uploaded_file($file_tmp, $destination)) {
        // Guardamos la ruta relativa que usará el HTML para renderizar el perfil
        $ruta_db = 'uploads/' . $new_file_name;

        try {
            // 4. Insertar los registros en SQLite con PDO
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, foto) VALUES (:name, :email, :password, :foto)");
            $stmt->execute([
                ':name' => $nombre,
                ':email' => $email,
                ':password' => $password_hash,
                ':foto' => $ruta_db
            ]);

            // Registro exitoso: Redirigir al Login o Dashboard
            header("Location: index.html?registro=exito");
            exit();

        } catch (PDOException $e) {
            // Si el correo ya existe, SQLite lanzará un error de restricción UNIQUE
            if ($e->getCode() == 23000) { 
                die("El correo electrónico ya se encuentra registrado.");
            } else {
                die("Error al guardar en la base de datos: " . $e->getMessage());
            }
        }
    } else {
        die("Error crítico al mover el archivo de perfil.");
    }
} else {
    // Si intentan entrar directo por URL, denegar
    header("Location: index.html");
    exit();
}
?>