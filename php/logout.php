<?php
require_once __DIR__ . '/session.php';

session_destroy();

$appRoot = dirname(dirname($_SERVER['SCRIPT_NAME']));
if ($appRoot === '/' || $appRoot === '\\') {
    $appRoot = '';
}

header("Location: {$appRoot}/index.php");
exit();
?>
