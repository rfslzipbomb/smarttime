<?php
$session_dir = __DIR__ . '/../sessions';
if (!file_exists($session_dir)) {
    mkdir($session_dir, 0777, true);
}
ini_set('session.save_path', $session_dir);
session_start();

$appRoot = dirname($_SERVER['SCRIPT_NAME']);
if ($appRoot === '/' || $appRoot === '\\') {
    $appRoot = '';
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: {$appRoot}/index.php?error=no_autenticado");
    exit();
}
?>