<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/conexion.php';

$correo = trim($_POST['correo'] ?? '');
$clave = $_POST['contrasena'] ?? '';

if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || $clave === '') {
    header('Location: index.php?error=credenciales');
    exit;
}

$correoSeguro = $conexion->real_escape_string($correo);
$resultado = $conexion->query("SELECT id, nombre, correo, contrasena FROM usuarios WHERE correo = '$correoSeguro' LIMIT 1");

if ($resultado && $resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($clave, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = (int)$usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_correo'] = $usuario['correo'];
        header('Location: dashboard.php');
        exit;
    }
}

header('Location: index.php?error=credenciales');
exit;
?>